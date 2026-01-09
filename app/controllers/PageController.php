<?php
/**
 * Page Controller
 */

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/PageModel.php';
require_once __DIR__ . '/../../PHPMailer-master/src/Exception.php';
require_once __DIR__ . '/../../PHPMailer-master/src/PHPMailer.php';
require_once __DIR__ . '/../../PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class PageController extends Controller {
    private $pageModel;
    
    public function __construct() {
        parent::__construct();
        $this->pageModel = new PageModel();
    }
    
    public function index() {
        $pageData = $this->pageModel->getPageData('index');
        $config = $this->pageModel->getConfig();
        
        // Add structured data for homepage
        $pageData['structured_data'] = $this->getHomeStructuredData();
        
        $this->view('pages/index', [
            'pageData' => $pageData,
            'config' => $config
        ]);
    }
    
    public function about() {
        $pageData = $this->pageModel->getPageData('about');
        $config = $this->pageModel->getConfig();
        
        // Add structured data for about page
        $pageData['structured_data'] = $this->getAboutStructuredData();
        
        $this->view('pages/about', [
            'pageData' => $pageData,
            'config' => $config
        ]);
    }
    
    public function products() {
        $pageData = $this->pageModel->getPageData('products');
        $config = $this->pageModel->getConfig();
        
        // Add structured data
        $pageData['structured_data'] = $this->getProductsStructuredData();
        
        $this->view('pages/products', [
            'pageData' => $pageData,
            'config' => $config
        ]);
    }
    
    public function contact() {
        // Handle POST request (form submission)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handleContactFormSubmission();
            return;
        }
        
        // Handle GET request (display form)
        $pageData = $this->pageModel->getPageData('contact');
        $config = $this->pageModel->getConfig();
        
        // Add structured data
        $pageData['structured_data'] = $this->getContactStructuredData();
        
        $this->view('pages/contact', [
            'pageData' => $pageData,
            'config' => $config
        ]);
    }
    
    private function handleContactFormSubmission() {
        // Start session if not already started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Check if this is an AJAX request
        $isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
                  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
        
        // Set JSON header for AJAX requests
        if ($isAjax) {
            header('Content-Type: application/json');
        }
        
        // Get client information for logging
        $clientIp = $this->getClientIp();
        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown';
        $referer = $_SERVER['HTTP_REFERER'] ?? 'Direct';
        $timestamp = date('Y-m-d H:i:s');
        
        // Validate input
        $errors = [];
        
        $name = isset($_POST['name']) ? trim($_POST['name']) : '';
        $email = isset($_POST['email']) ? trim($_POST['email']) : '';
        $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
        $company = isset($_POST['company']) ? trim($_POST['company']) : '';
        $customerType = isset($_POST['customerType']) ? trim($_POST['customerType']) : '';
        $message = isset($_POST['message']) ? trim($_POST['message']) : '';
        
        // Validate required fields
        if (empty($name) || strlen($name) < 2 || strlen($name) > 100) {
            $errors[] = 'Please enter a valid name (2-100 characters).';
        }
        
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 255) {
            $errors[] = 'Please enter a valid email address.';
        }
        
        if (empty($phone) || !preg_match('/^[\d\s\-\+\(\)]{10,20}$/', $phone)) {
            $errors[] = 'Please enter a valid phone number.';
        }
        
        if (empty($customerType) || !in_array($customerType, ['b2b', 'individual'])) {
            $errors[] = 'Please select your customer type.';
        }
        
        if (empty($message) || strlen($message) < 10 || strlen($message) > 1000) {
            $errors[] = 'Please enter a message (10-1000 characters).';
        }
        
        // Validate company if provided
        if (!empty($company) && strlen($company) > 100) {
            $errors[] = 'Company name must be less than 100 characters.';
        }
        
        // If there are validation errors
        if (!empty($errors)) {
            // Log validation error
            $this->logContactFormSubmission([
                'status' => 'VALIDATION_ERROR',
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'company' => $company,
                'customerType' => $customerType,
                'message' => substr($message, 0, 500), // Limit message length in log
                'errors' => $errors,
                'timestamp' => $timestamp,
                'ip' => $clientIp,
                'user_agent' => $userAgent,
                'referer' => $referer,
                'is_ajax' => $isAjax
            ]);
            
            if ($isAjax) {
                echo json_encode([
                    'success' => false,
                    'message' => implode(' ', $errors)
                ]);
            } else {
                // For non-AJAX, redirect back with error
                $_SESSION['contact_error'] = implode(' ', $errors);
                header('Location: ' . BASE_URL . '/contact');
            }
            exit;
        }
        
        // Send email using PHPMailer
        try {
            $mail = new PHPMailer(true);
            
            // Server settings
            $mail->isSMTP();
            $mail->Host = SMTP_HOST;
            $mail->SMTPAuth = true;
            $mail->Username = SMTP_USERNAME;
            $mail->Password = SMTP_PASSWORD;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = SMTP_PORT;
            $mail->CharSet = 'UTF-8';
            
            // Enable SMTP debugging (for logging)
            $mail->SMTPDebug = 0; // Set to 0 for production, 2 for detailed debugging
            $mail->Debugoutput = function($str, $level) {
                // This will be captured in our detailed logging
            };
            
            // Check if password is set
            if (empty(SMTP_PASSWORD)) {
                throw new Exception('SMTP password is not configured. Please set SMTP_PASSWORD in config.php');
            }
            
            // Recipients
            $fromEmail = !empty(SMTP_FROM_EMAIL) ? SMTP_FROM_EMAIL : SITE_EMAIL;
            $fromName = !empty(SMTP_FROM_NAME) ? SMTP_FROM_NAME : SITE_NAME;
            $mail->setFrom($fromEmail, $fromName);
            $mail->addAddress(SITE_EMAIL, SITE_NAME);
            $mail->addReplyTo($email, $name);
            
            // Content
            $mail->isHTML(true);
            $mail->Subject = 'New Contact Form Submission - ' . SITE_NAME;
            
            // Build professional email body
            $customerTypeLabel = $customerType === 'b2b' ? 'B2B Customer (Wholesale/Business)' : 'Individual Customer';
            $customerTypeIcon = $customerType === 'b2b' ? '🏢' : '👤';
            $submissionDate = date('F j, Y');
            $submissionTime = date('g:i a T');
            
            $emailBody = $this->buildContactEmailTemplate([
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'company' => $company,
                'customerType' => $customerTypeLabel,
                'customerTypeIcon' => $customerTypeIcon,
                'message' => $message,
                'submissionDate' => $submissionDate,
                'submissionTime' => $submissionTime
            ]);
            
            $mail->Body = $emailBody;
            
            // Plain text version
            $mail->AltBody = "New Contact Form Submission\n\n";
            $mail->AltBody .= "Name: " . $name . "\n";
            $mail->AltBody .= "Email: " . $email . "\n";
            $mail->AltBody .= "Phone: " . $phone . "\n";
            if (!empty($company)) {
                $mail->AltBody .= "Company: " . $company . "\n";
            }
            $mail->AltBody .= "Customer Type: " . $customerTypeLabel . "\n";
            $mail->AltBody .= "Message: " . $message . "\n";
            $mail->AltBody .= "\nSubmitted on " . date('F j, Y, g:i a T');
            
            $mail->send();
            
            $adminEmailSent = true;
            $adminEmailError = null;
            
            // Send thank you email to the customer
            $thankYouEmailSent = false;
            $thankYouEmailError = null;
            
            try {
                $thankYouMail = new PHPMailer(true);
                
                // Server settings
                $thankYouMail->isSMTP();
                $thankYouMail->Host = SMTP_HOST;
                $thankYouMail->SMTPAuth = true;
                $thankYouMail->Username = SMTP_USERNAME;
                $thankYouMail->Password = SMTP_PASSWORD;
                $thankYouMail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $thankYouMail->Port = SMTP_PORT;
                $thankYouMail->CharSet = 'UTF-8';
                
                // Enable SMTP debugging (for logging)
                $thankYouMail->SMTPDebug = 0; // Set to 0 for production, 2 for detailed debugging
                $thankYouMail->Debugoutput = function($str, $level) {
                    // This will be captured in our detailed logging
                };
                
                // Recipients
                $fromEmail = !empty(SMTP_FROM_EMAIL) ? SMTP_FROM_EMAIL : SITE_EMAIL;
                $fromName = !empty(SMTP_FROM_NAME) ? SMTP_FROM_NAME : SITE_NAME;
                $thankYouMail->setFrom($fromEmail, $fromName);
                $thankYouMail->addAddress($email, $name);
                
                // Content
                $thankYouMail->isHTML(true);
                $thankYouMail->Subject = 'Thank You for Contacting ' . SITE_NAME;
                
                // Build thank you email body
                $thankYouBody = $this->buildThankYouEmailTemplate([
                    'name' => $name,
                    'customerType' => $customerTypeLabel
                ]);
                
                $thankYouMail->Body = $thankYouBody;
                
                // Plain text version
                $thankYouMail->AltBody = "Thank You for Contacting " . SITE_NAME . "\n\n";
                $thankYouMail->AltBody .= "Dear " . $name . ",\n\n";
                $thankYouMail->AltBody .= "Thank you for reaching out to us! We have received your inquiry and one of our team members will get back to you shortly.\n\n";
                $thankYouMail->AltBody .= "At " . SITE_NAME . ", we are committed to providing you with the best service and premium quality spices, seeds, and powders.\n\n";
                $thankYouMail->AltBody .= "In the meantime, feel free to explore our website or contact us directly if you have any urgent questions.\n\n";
                $thankYouMail->AltBody .= "Best regards,\n";
                $thankYouMail->AltBody .= "The " . SITE_NAME . " Team\n\n";
                $thankYouMail->AltBody .= "Phone: " . SITE_PHONE . "\n";
                $thankYouMail->AltBody .= "Email: " . SITE_EMAIL . "\n";
                $thankYouMail->AltBody .= "Address: " . SITE_ADDRESS . "\n";
                $thankYouMail->AltBody .= "\n" . BASE_URL;
                
                $thankYouMail->send();
                $thankYouEmailSent = true;
            } catch (Exception $thankYouException) {
                // Log thank you email error but don't fail the whole process
                $thankYouEmailSent = false;
                $thankYouEmailError = (isset($thankYouMail) && !empty($thankYouMail->ErrorInfo)) 
                    ? $thankYouMail->ErrorInfo 
                    : $thankYouException->getMessage();
                
                // Log detailed SMTP error
                $this->logSMTPError([
                    'email_type' => 'thank_you_email',
                    'exception' => $thankYouException,
                    'phpmailer' => isset($thankYouMail) ? $thankYouMail : null,
                    'recipient_email' => $email,
                    'recipient_name' => $name,
                    'subject' => 'Thank You for Contacting ' . SITE_NAME,
                    'contact_form_data' => [
                        'name' => $name,
                        'email' => $email,
                        'phone' => $phone,
                        'company' => $company,
                        'customer_type' => $customerType
                    ]
                ]);
                
                error_log('Thank you email error: ' . $thankYouEmailError);
            }
            
            // Log successful submission
            $this->logContactFormSubmission([
                'status' => 'SUCCESS',
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'company' => $company,
                'customerType' => $customerType,
                'customerTypeLabel' => $customerTypeLabel,
                'message' => substr($message, 0, 500), // Limit message length in log
                'timestamp' => $timestamp,
                'ip' => $clientIp,
                'user_agent' => $userAgent,
                'referer' => $referer,
                'is_ajax' => $isAjax,
                'admin_email_sent' => $adminEmailSent,
                'thank_you_email_sent' => $thankYouEmailSent,
                'thank_you_email_error' => $thankYouEmailError
            ]);
            
            // Success response
            if ($isAjax) {
                echo json_encode([
                    'success' => true,
                    'message' => 'Thank you! Your message has been sent successfully. We will get back to you soon.'
                ]);
            } else {
                $_SESSION['contact_success'] = 'Thank you! Your message has been sent successfully. We will get back to you soon.';
                header('Location: ' . BASE_URL . '/contact');
            }
            
        } catch (Exception $e) {
            // Error sending email
            $errorMessage = isset($mail) ? $mail->ErrorInfo : $e->getMessage();
            error_log('Contact form error: ' . $errorMessage);
            
            // Log detailed SMTP error
            $this->logSMTPError([
                'email_type' => 'admin_notification_email',
                'exception' => $e,
                'phpmailer' => isset($mail) ? $mail : null,
                'recipient_email' => SITE_EMAIL,
                'recipient_name' => SITE_NAME,
                'subject' => 'New Contact Form Submission - ' . SITE_NAME,
                'contact_form_data' => [
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'company' => $company,
                    'customer_type' => $customerType,
                    'message' => substr($message, 0, 500)
                ]
            ]);
            
            // Log error submission
            $this->logContactFormSubmission([
                'status' => 'EMAIL_ERROR',
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'company' => $company,
                'customerType' => $customerType,
                'message' => substr($message, 0, 500), // Limit message length in log
                'error' => $errorMessage,
                'timestamp' => $timestamp,
                'ip' => $clientIp,
                'user_agent' => $userAgent,
                'referer' => $referer,
                'is_ajax' => $isAjax
            ]);
            
            if ($isAjax) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Sorry, there was an error sending your message. Please try again later or contact us directly at ' . SITE_EMAIL . '.'
                ]);
            } else {
                $_SESSION['contact_error'] = 'Sorry, there was an error sending your message. Please try again later.';
                header('Location: ' . BASE_URL . '/contact');
            }
        }
        
        exit;
    }
    
    /**
     * Get client IP address
     */
    private function getClientIp() {
        $ipKeys = ['HTTP_CF_CONNECTING_IP', 'HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR'];
        
        foreach ($ipKeys as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip);
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                        return $ip;
                    }
                }
            }
        }
        
        return $_SERVER['REMOTE_ADDR'] ?? 'Unknown';
    }
    
    /**
     * Log contact form submission details to file
     */
    private function logContactFormSubmission($data) {
        // Ensure logs directory exists
        if (!file_exists(LOGS_PATH)) {
            @mkdir(LOGS_PATH, 0755, true);
        }
        
        // Create log file name with date (one file per day)
        $logFile = LOGS_PATH . '/contact_form_' . date('Y-m-d') . '.log';
        
        // Prepare log entry
        $logEntry = [
            'timestamp' => $data['timestamp'] ?? date('Y-m-d H:i:s'),
            'status' => $data['status'] ?? 'UNKNOWN',
            'name' => $data['name'] ?? '',
            'email' => $data['email'] ?? '',
            'phone' => $data['phone'] ?? '',
            'company' => $data['company'] ?? '',
            'customer_type' => $data['customerType'] ?? '',
            'customer_type_label' => $data['customerTypeLabel'] ?? '',
            'message' => $data['message'] ?? '',
            'ip_address' => $data['ip'] ?? 'Unknown',
            'user_agent' => $data['user_agent'] ?? 'Unknown',
            'referer' => $data['referer'] ?? 'Direct',
            'is_ajax' => $data['is_ajax'] ?? false
        ];
        
        // Add status-specific information
        if (isset($data['errors']) && !empty($data['errors'])) {
            $logEntry['validation_errors'] = $data['errors'];
        }
        
        if (isset($data['error'])) {
            $logEntry['error_message'] = $data['error'];
        }
        
        if (isset($data['admin_email_sent'])) {
            $logEntry['admin_email_sent'] = $data['admin_email_sent'];
        }
        
        if (isset($data['thank_you_email_sent'])) {
            $logEntry['thank_you_email_sent'] = $data['thank_you_email_sent'];
        }
        
        if (isset($data['thank_you_email_error']) && !empty($data['thank_you_email_error'])) {
            $logEntry['thank_you_email_error'] = $data['thank_you_email_error'];
        }
        
        // Format log entry as JSON (one line per entry for easy parsing)
        $logLine = json_encode($logEntry, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . PHP_EOL;
        
        // Write to log file (append mode)
        @file_put_contents($logFile, $logLine, FILE_APPEND | LOCK_EX);
        
        // Also create a human-readable log entry
        $readableLogFile = LOGS_PATH . '/contact_form_readable_' . date('Y-m-d') . '.log';
        $readableEntry = $this->formatReadableLogEntry($logEntry);
        @file_put_contents($readableLogFile, $readableEntry, FILE_APPEND | LOCK_EX);
    }
    
    /**
     * Format log entry in human-readable format
     */
    private function formatReadableLogEntry($entry) {
        $output = str_repeat('=', 80) . PHP_EOL;
        $output .= "TIMESTAMP: " . $entry['timestamp'] . PHP_EOL;
        $output .= "STATUS: " . $entry['status'] . PHP_EOL;
        $output .= str_repeat('-', 80) . PHP_EOL;
        $output .= "CONTACT INFORMATION:" . PHP_EOL;
        $output .= "  Name: " . ($entry['name'] ?: 'N/A') . PHP_EOL;
        $output .= "  Email: " . ($entry['email'] ?: 'N/A') . PHP_EOL;
        $output .= "  Phone: " . ($entry['phone'] ?: 'N/A') . PHP_EOL;
        $output .= "  Company: " . ($entry['company'] ?: 'N/A') . PHP_EOL;
        $output .= "  Customer Type: " . ($entry['customer_type_label'] ?: $entry['customer_type'] ?: 'N/A') . PHP_EOL;
        $output .= PHP_EOL;
        $output .= "MESSAGE:" . PHP_EOL;
        $output .= "  " . wordwrap($entry['message'] ?: 'N/A', 76, PHP_EOL . "  ") . PHP_EOL;
        $output .= PHP_EOL;
        $output .= "TECHNICAL DETAILS:" . PHP_EOL;
        $output .= "  IP Address: " . $entry['ip_address'] . PHP_EOL;
        $output .= "  User Agent: " . $entry['user_agent'] . PHP_EOL;
        $output .= "  Referer: " . $entry['referer'] . PHP_EOL;
        $output .= "  Request Type: " . ($entry['is_ajax'] ? 'AJAX' : 'Standard') . PHP_EOL;
        
        // Add status-specific details
        if (isset($entry['validation_errors'])) {
            $output .= PHP_EOL;
            $output .= "VALIDATION ERRORS:" . PHP_EOL;
            foreach ($entry['validation_errors'] as $error) {
                $output .= "  - " . $error . PHP_EOL;
            }
        }
        
        if (isset($entry['error_message'])) {
            $output .= PHP_EOL;
            $output .= "ERROR MESSAGE:" . PHP_EOL;
            $output .= "  " . wordwrap($entry['error_message'], 76, PHP_EOL . "  ") . PHP_EOL;
        }
        
        if (isset($entry['admin_email_sent'])) {
            $output .= PHP_EOL;
            $output .= "EMAIL STATUS:" . PHP_EOL;
            $output .= "  Admin Email: " . ($entry['admin_email_sent'] ? 'Sent ✓' : 'Failed ✗') . PHP_EOL;
            if (isset($entry['thank_you_email_sent'])) {
                $output .= "  Thank You Email: " . ($entry['thank_you_email_sent'] ? 'Sent ✓' : 'Failed ✗') . PHP_EOL;
                if (isset($entry['thank_you_email_error']) && !empty($entry['thank_you_email_error'])) {
                    $output .= "    Error: " . $entry['thank_you_email_error'] . PHP_EOL;
                }
            }
        }
        
        $output .= str_repeat('=', 80) . PHP_EOL;
        $output .= PHP_EOL;
        
        return $output;
    }
    
    /**
     * Log detailed SMTP errors to dedicated log file
     * This function captures all SMTP-related errors with complete details
     */
    private function logSMTPError($data) {
        // Ensure logs directory exists
        if (!file_exists(LOGS_PATH)) {
            @mkdir(LOGS_PATH, 0755, true);
        }
        
        // Create log file name with date (one file per day)
        $logFile = LOGS_PATH . '/smtp_errors_' . date('Y-m-d') . '.log';
        
        // Extract exception details
        $exception = $data['exception'] ?? null;
        $phpmailer = $data['phpmailer'] ?? null;
        
        // Get exception information
        $exceptionMessage = $exception ? $exception->getMessage() : 'Unknown error';
        $exceptionCode = $exception ? $exception->getCode() : 0;
        $exceptionFile = $exception ? $exception->getFile() : 'Unknown';
        $exceptionLine = $exception ? $exception->getLine() : 0;
        $exceptionTrace = $exception ? $exception->getTraceAsString() : 'No trace available';
        
        // Get PHPMailer error information
        $phpmailerErrorInfo = null;
        $smtpHost = null;
        $smtpPort = null;
        $smtpUsername = null;
        $smtpSecure = null;
        $smtpAuth = null;
        $fromEmail = null;
        $fromName = null;
        $toEmails = [];
        $subject = null;
        $bodyLength = null;
        
        if ($phpmailer instanceof PHPMailer) {
            $phpmailerErrorInfo = $phpmailer->ErrorInfo ?? null;
            $smtpHost = $phpmailer->Host ?? null;
            $smtpPort = $phpmailer->Port ?? null;
            $smtpUsername = $phpmailer->Username ?? null;
            $smtpSecure = $phpmailer->SMTPSecure ?? null;
            $smtpAuth = $phpmailer->SMTPAuth ?? null;
            $fromEmail = $phpmailer->From ?? null;
            $fromName = $phpmailer->FromName ?? null;
            
            // Get all recipients using public methods
            try {
                $allToAddresses = $phpmailer->getToAddresses();
                foreach ($allToAddresses as $to) {
                    $toEmails[] = [
                        'email' => $to[0] ?? null,
                        'name' => $to[1] ?? null
                    ];
                }
            } catch (Exception $e) {
                // If we can't get recipients, leave empty
            }
            
            $subject = $phpmailer->Subject ?? null;
            try {
                $bodyLength = $phpmailer->Body ? strlen($phpmailer->Body) : null;
            } catch (Exception $e) {
                $bodyLength = null;
            }
        }
        
        // Prepare comprehensive log entry
        $logEntry = [
            'timestamp' => date('Y-m-d H:i:s'),
            'email_type' => $data['email_type'] ?? 'unknown',
            'error' => [
                'message' => $exceptionMessage,
                'code' => $exceptionCode,
                'file' => $exceptionFile,
                'line' => $exceptionLine,
                'phpmailer_error_info' => $phpmailerErrorInfo,
                'trace' => $exceptionTrace
            ],
            'smtp_configuration' => [
                'host' => $smtpHost ?? SMTP_HOST,
                'port' => $smtpPort ?? SMTP_PORT,
                'username' => $smtpUsername ?? SMTP_USERNAME,
                'password_set' => !empty(SMTP_PASSWORD),
                'encryption' => $smtpSecure ?? 'STARTTLS',
                'auth_enabled' => $smtpAuth ?? true
            ],
            'email_details' => [
                'from_email' => $fromEmail ?? (!empty(SMTP_FROM_EMAIL) ? SMTP_FROM_EMAIL : SITE_EMAIL),
                'from_name' => $fromName ?? (!empty(SMTP_FROM_NAME) ? SMTP_FROM_NAME : SITE_NAME),
                'to_emails' => !empty($toEmails) ? $toEmails : [
                    [
                        'email' => $data['recipient_email'] ?? 'Unknown',
                        'name' => $data['recipient_name'] ?? 'Unknown'
                    ]
                ],
                'subject' => $subject ?? $data['subject'] ?? 'Unknown',
                'body_length' => $bodyLength ?? 'Unknown',
                'is_html' => $phpmailer ? ($phpmailer->isHTML() ?? false) : false
            ],
            'contact_form_data' => $data['contact_form_data'] ?? null,
            'server_info' => [
                'php_version' => PHP_VERSION,
                'server_software' => $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown',
                'request_method' => $_SERVER['REQUEST_METHOD'] ?? 'Unknown',
                'request_uri' => $_SERVER['REQUEST_URI'] ?? 'Unknown',
                'ip_address' => $this->getClientIp(),
                'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown'
            ]
        ];
        
        // Format log entry as JSON (one line per entry for easy parsing)
        $logLine = json_encode($logEntry, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . PHP_EOL;
        
        // Write to log file (append mode)
        @file_put_contents($logFile, $logLine, FILE_APPEND | LOCK_EX);
        
        // Also create a human-readable log entry
        $readableLogFile = LOGS_PATH . '/smtp_errors_readable_' . date('Y-m-d') . '.log';
        $readableEntry = $this->formatReadableSMTPErrorLog($logEntry);
        @file_put_contents($readableLogFile, $readableEntry, FILE_APPEND | LOCK_EX);
    }
    
    /**
     * Format SMTP error log entry in human-readable format
     */
    private function formatReadableSMTPErrorLog($entry) {
        $output = str_repeat('=', 100) . PHP_EOL;
        $output .= "SMTP ERROR LOG ENTRY" . PHP_EOL;
        $output .= str_repeat('=', 100) . PHP_EOL;
        $output .= "TIMESTAMP: " . $entry['timestamp'] . PHP_EOL;
        $output .= "EMAIL TYPE: " . strtoupper($entry['email_type']) . PHP_EOL;
        $output .= str_repeat('-', 100) . PHP_EOL;
        
        // Error Details
        $output .= "ERROR DETAILS:" . PHP_EOL;
        $output .= "  Message: " . $entry['error']['message'] . PHP_EOL;
        $output .= "  Code: " . $entry['error']['code'] . PHP_EOL;
        $output .= "  File: " . $entry['error']['file'] . PHP_EOL;
        $output .= "  Line: " . $entry['error']['line'] . PHP_EOL;
        if (!empty($entry['error']['phpmailer_error_info'])) {
            $output .= "  PHPMailer Error Info: " . $entry['error']['phpmailer_error_info'] . PHP_EOL;
        }
        $output .= PHP_EOL;
        
        // SMTP Configuration
        $output .= "SMTP CONFIGURATION:" . PHP_EOL;
        $output .= "  Host: " . $entry['smtp_configuration']['host'] . PHP_EOL;
        $output .= "  Port: " . $entry['smtp_configuration']['port'] . PHP_EOL;
        $output .= "  Username: " . $entry['smtp_configuration']['username'] . PHP_EOL;
        $output .= "  Password Set: " . ($entry['smtp_configuration']['password_set'] ? 'Yes' : 'No') . PHP_EOL;
        $output .= "  Encryption: " . $entry['smtp_configuration']['encryption'] . PHP_EOL;
        $output .= "  Auth Enabled: " . ($entry['smtp_configuration']['auth_enabled'] ? 'Yes' : 'No') . PHP_EOL;
        $output .= PHP_EOL;
        
        // Email Details
        $output .= "EMAIL DETAILS:" . PHP_EOL;
        $output .= "  From Email: " . $entry['email_details']['from_email'] . PHP_EOL;
        $output .= "  From Name: " . $entry['email_details']['from_name'] . PHP_EOL;
        $output .= "  To Emails:" . PHP_EOL;
        foreach ($entry['email_details']['to_emails'] as $to) {
            $output .= "    - " . $to['email'] . ($to['name'] ? ' (' . $to['name'] . ')' : '') . PHP_EOL;
        }
        $output .= "  Subject: " . $entry['email_details']['subject'] . PHP_EOL;
        $output .= "  Body Length: " . $entry['email_details']['body_length'] . " bytes" . PHP_EOL;
        $output .= "  Is HTML: " . ($entry['email_details']['is_html'] ? 'Yes' : 'No') . PHP_EOL;
        $output .= PHP_EOL;
        
        // Contact Form Data (if available)
        if (!empty($entry['contact_form_data'])) {
            $output .= "CONTACT FORM DATA:" . PHP_EOL;
            $cfData = $entry['contact_form_data'];
            if (isset($cfData['name'])) {
                $output .= "  Name: " . $cfData['name'] . PHP_EOL;
            }
            if (isset($cfData['email'])) {
                $output .= "  Email: " . $cfData['email'] . PHP_EOL;
            }
            if (isset($cfData['phone'])) {
                $output .= "  Phone: " . $cfData['phone'] . PHP_EOL;
            }
            if (isset($cfData['company'])) {
                $output .= "  Company: " . $cfData['company'] . PHP_EOL;
            }
            if (isset($cfData['customer_type'])) {
                $output .= "  Customer Type: " . $cfData['customer_type'] . PHP_EOL;
            }
            $output .= PHP_EOL;
        }
        
        // Server Info
        $output .= "SERVER INFORMATION:" . PHP_EOL;
        $output .= "  PHP Version: " . $entry['server_info']['php_version'] . PHP_EOL;
        $output .= "  Server Software: " . $entry['server_info']['server_software'] . PHP_EOL;
        $output .= "  Request Method: " . $entry['server_info']['request_method'] . PHP_EOL;
        $output .= "  Request URI: " . $entry['server_info']['request_uri'] . PHP_EOL;
        $output .= "  IP Address: " . $entry['server_info']['ip_address'] . PHP_EOL;
        $output .= "  User Agent: " . $entry['server_info']['user_agent'] . PHP_EOL;
        $output .= PHP_EOL;
        
        // Stack Trace
        if (!empty($entry['error']['trace'])) {
            $output .= "STACK TRACE:" . PHP_EOL;
            $output .= str_repeat('-', 100) . PHP_EOL;
            $traceLines = explode("\n", $entry['error']['trace']);
            foreach ($traceLines as $traceLine) {
                $output .= "  " . $traceLine . PHP_EOL;
            }
            $output .= PHP_EOL;
        }
        
        $output .= str_repeat('=', 100) . PHP_EOL;
        $output .= PHP_EOL;
        
        return $output;
    }
    
    /**
     * Build professional HTML email template for contact form submissions
     */
    private function buildContactEmailTemplate($data) {
        $name = htmlspecialchars($data['name'], ENT_QUOTES, 'UTF-8');
        $email = htmlspecialchars($data['email'], ENT_QUOTES, 'UTF-8');
        $phone = htmlspecialchars($data['phone'], ENT_QUOTES, 'UTF-8');
        $company = !empty($data['company']) ? htmlspecialchars($data['company'], ENT_QUOTES, 'UTF-8') : null;
        $customerType = htmlspecialchars($data['customerType'], ENT_QUOTES, 'UTF-8');
        $customerTypeIcon = $data['customerTypeIcon'];
        $message = nl2br(htmlspecialchars($data['message'], ENT_QUOTES, 'UTF-8'));
        $submissionDate = $data['submissionDate'];
        $submissionTime = $data['submissionTime'];
        
        // Build email body
        $emailBody = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Form Submission</title>
</head>
<body style="margin: 0; padding: 0; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, \'Helvetica Neue\', Arial, sans-serif; background-color: #f4f6f9; line-height: 1.6;">
    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="background-color: #f4f6f9;">
        <tr>
            <td align="center" style="padding: 40px 20px;">
                <!-- Main Container -->
                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="600" style="max-width: 600px; background-color: #ffffff; border-radius: 12px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); overflow: hidden;">
                    
                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 40px 40px 35px; text-align: center;">
                            <h1 style="margin: 0; color: #ffffff; font-size: 28px; font-weight: 700; letter-spacing: -0.5px;">New Contact Form Submission</h1>
                            <p style="margin: 10px 0 0; color: rgba(255, 255, 255, 0.9); font-size: 16px; font-weight: 400;">' . SITE_NAME . '</p>
                        </td>
                    </tr>
                    
                    <!-- Content -->
                    <tr>
                        <td style="padding: 40px;">
                            
                            <!-- Alert Box -->
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin-bottom: 30px;">
                                <tr>
                                    <td style="background-color: #e3f2fd; border-left: 4px solid #2196f3; padding: 16px 20px; border-radius: 6px;">
                                        <p style="margin: 0; color: #1565c0; font-size: 14px; font-weight: 600;">
                                            📬 You have received a new inquiry from your website contact form
                                        </p>
                                    </td>
                                </tr>
                            </table>
                            
                            <!-- Contact Information Section -->
                            <h2 style="margin: 0 0 20px; color: #1a1a1a; font-size: 20px; font-weight: 600; border-bottom: 2px solid #f0f0f0; padding-bottom: 12px;">
                                Contact Information
                            </h2>
                            
                            <!-- Name -->
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin-bottom: 16px;">
                                <tr>
                                    <td style="padding: 16px; background-color: #f8f9fa; border-radius: 8px; border-left: 4px solid #667eea;">
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                            <tr>
                                                <td style="width: 140px; vertical-align: top;">
                                                    <strong style="color: #495057; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">👤 Name</strong>
                                                </td>
                                                <td style="vertical-align: top;">
                                                    <p style="margin: 0; color: #212529; font-size: 15px; font-weight: 500;">' . $name . '</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            
                            <!-- Email -->
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin-bottom: 16px;">
                                <tr>
                                    <td style="padding: 16px; background-color: #f8f9fa; border-radius: 8px; border-left: 4px solid #667eea;">
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                            <tr>
                                                <td style="width: 140px; vertical-align: top;">
                                                    <strong style="color: #495057; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">✉️ Email</strong>
                                                </td>
                                                <td style="vertical-align: top;">
                                                    <p style="margin: 0;">
                                                        <a href="mailto:' . $email . '" style="color: #667eea; font-size: 15px; font-weight: 500; text-decoration: none;">' . $email . '</a>
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            
                            <!-- Phone -->
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin-bottom: 16px;">
                                <tr>
                                    <td style="padding: 16px; background-color: #f8f9fa; border-radius: 8px; border-left: 4px solid #667eea;">
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                            <tr>
                                                <td style="width: 140px; vertical-align: top;">
                                                    <strong style="color: #495057; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">📱 Phone</strong>
                                                </td>
                                                <td style="vertical-align: top;">
                                                    <p style="margin: 0;">
                                                        <a href="tel:' . preg_replace('/[^0-9+]/', '', $phone) . '" style="color: #667eea; font-size: 15px; font-weight: 500; text-decoration: none;">' . $phone . '</a>
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>';
        
        // Company field (if provided)
        if ($company) {
            $emailBody .= '
                            <!-- Company -->
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin-bottom: 16px;">
                                <tr>
                                    <td style="padding: 16px; background-color: #f8f9fa; border-radius: 8px; border-left: 4px solid #667eea;">
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                            <tr>
                                                <td style="width: 140px; vertical-align: top;">
                                                    <strong style="color: #495057; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">🏢 Company</strong>
                                                </td>
                                                <td style="vertical-align: top;">
                                                    <p style="margin: 0; color: #212529; font-size: 15px; font-weight: 500;">' . $company . '</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>';
        }
        
        $emailBody .= '
                            <!-- Customer Type -->
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin-bottom: 30px;">
                                <tr>
                                    <td style="padding: 16px; background-color: #fff3cd; border-radius: 8px; border-left: 4px solid #ffc107;">
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                            <tr>
                                                <td style="width: 140px; vertical-align: top;">
                                                    <strong style="color: #856404; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">' . $customerTypeIcon . ' Type</strong>
                                                </td>
                                                <td style="vertical-align: top;">
                                                    <p style="margin: 0; color: #856404; font-size: 15px; font-weight: 600;">' . $customerType . '</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            
                            <!-- Message Section -->
                            <h2 style="margin: 0 0 20px; color: #1a1a1a; font-size: 20px; font-weight: 600; border-bottom: 2px solid #f0f0f0; padding-bottom: 12px;">
                                Message / Inquiry
                            </h2>
                            
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin-bottom: 30px;">
                                <tr>
                                    <td style="padding: 20px; background-color: #f8f9fa; border-radius: 8px; border-left: 4px solid #28a745;">
                                        <p style="margin: 0; color: #212529; font-size: 15px; line-height: 1.7; white-space: pre-wrap;">' . $message . '</p>
                                    </td>
                                </tr>
                            </table>
                            
                            <!-- Action Buttons -->
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin-bottom: 30px;">
                                <tr>
                                    <td align="center">
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0">
                                            <tr>
                                                <td style="background-color: #667eea; border-radius: 6px; padding: 12px 30px;">
                                                    <a href="mailto:' . $email . '?subject=Re: Your Inquiry - ' . urlencode(SITE_NAME) . '" style="color: #ffffff; font-size: 15px; font-weight: 600; text-decoration: none; display: inline-block;">Reply to Customer</a>
                                                </td>
                                                <td style="width: 15px;"></td>
                                                <td style="background-color: #28a745; border-radius: 6px; padding: 12px 30px;">
                                                    <a href="tel:' . preg_replace('/[^0-9+]/', '', $phone) . '" style="color: #ffffff; font-size: 15px; font-weight: 600; text-decoration: none; display: inline-block;">Call Customer</a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            
                            <!-- Footer Info -->
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                <tr>
                                    <td style="padding: 20px; background-color: #f8f9fa; border-radius: 8px; text-align: center;">
                                        <p style="margin: 0 0 8px; color: #6c757d; font-size: 13px;">
                                            <strong>Submitted:</strong> ' . $submissionDate . ' at ' . $submissionTime . '
                                        </p>
                                        <p style="margin: 0; color: #adb5bd; font-size: 12px;">
                                            This is an automated email from ' . SITE_NAME . ' contact form
                                        </p>
                                    </td>
                                </tr>
                            </table>
                            
                        </td>
                    </tr>
                    
                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f8f9fa; padding: 25px 40px; text-align: center; border-top: 1px solid #e9ecef;">
                            <p style="margin: 0; color: #6c757d; font-size: 13px;">
                                <strong>' . SITE_NAME . '</strong><br>
                                ' . SITE_ADDRESS . '<br>
                                ' . SITE_PHONE . ' | <a href="mailto:' . SITE_EMAIL . '" style="color: #667eea; text-decoration: none;">' . SITE_EMAIL . '</a>
                            </p>
                        </td>
                    </tr>
                    
                </table>
            </td>
        </tr>
    </table>
</body>
</html>';
        
        return $emailBody;
    }
    
    /**
     * Build professional HTML thank you email template for customers
     */
    private function buildThankYouEmailTemplate($data) {
        $name = htmlspecialchars($data['name'], ENT_QUOTES, 'UTF-8');
        $customerType = htmlspecialchars($data['customerType'], ENT_QUOTES, 'UTF-8');
        
        return '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You for Contacting ' . SITE_NAME . '</title>
</head>
<body style="margin: 0; padding: 0; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, \'Helvetica Neue\', Arial, sans-serif; background-color: #f4f6f9; line-height: 1.6;">
    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="background-color: #f4f6f9;">
        <tr>
            <td align="center" style="padding: 40px 20px;">
                <!-- Main Container -->
                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="600" style="max-width: 600px; background-color: #ffffff; border-radius: 12px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); overflow: hidden;">
                    
                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 50px 40px; text-align: center;">
                            <div style="font-size: 64px; margin-bottom: 20px;">✨</div>
                            <h1 style="margin: 0; color: #ffffff; font-size: 32px; font-weight: 700; letter-spacing: -0.5px;">Thank You!</h1>
                            <p style="margin: 10px 0 0; color: rgba(255, 255, 255, 0.95); font-size: 18px; font-weight: 400;">We\'ve received your message</p>
                        </td>
                    </tr>
                    
                    <!-- Content -->
                    <tr>
                        <td style="padding: 50px 40px;">
                            
                            <!-- Greeting -->
                            <p style="margin: 0 0 25px; color: #212529; font-size: 18px; font-weight: 500; line-height: 1.6;">
                                Dear ' . $name . ',
                            </p>
                            
                            <!-- Main Message -->
                            <p style="margin: 0 0 20px; color: #495057; font-size: 16px; line-height: 1.8;">
                                Thank you for reaching out to <strong style="color: #667eea;">' . SITE_NAME . '</strong>! We have received your inquiry and our team is excited to assist you.
                            </p>
                            
                            <p style="margin: 0 0 25px; color: #495057; font-size: 16px; line-height: 1.8;">
                                One of our experienced team members will review your message and get back to you within <strong>24-48 hours</strong>. We\'re committed to providing you with the best service and helping you find the perfect spice solutions for your needs.
                            </p>
                            
                            <!-- Info Box -->
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: 30px 0;">
                                <tr>
                                    <td style="background: linear-gradient(135deg, #e3f2fd 0%, #f3e5f5 100%); border-left: 4px solid #667eea; padding: 20px; border-radius: 8px;">
                                        <p style="margin: 0 0 10px; color: #1565c0; font-size: 15px; font-weight: 600;">
                                            🎯 What happens next?
                                        </p>
                                        <ul style="margin: 0; padding-left: 20px; color: #424242; font-size: 14px; line-height: 1.8;">
                                            <li>Our team will review your inquiry carefully</li>
                                            <li>We\'ll prepare a personalized response with relevant information</li>
                                            <li>You\'ll receive a detailed reply via email or phone call</li>
                                        </ul>
                                    </td>
                                </tr>
                            </table>
                            
                            <!-- Customer Type Specific Message -->
                            <div style="background-color: #f8f9fa; padding: 20px; border-radius: 8px; margin: 25px 0;">
                                <p style="margin: 0; color: #495057; font-size: 15px; line-height: 1.7;">
                                    <strong style="color: #667eea;">As a ' . $customerType . ',</strong> we understand your unique requirements and are ready to provide you with premium quality Indian spices, seeds, and powders that meet international standards.
                                </p>
                            </div>
                            
                            <!-- Quick Links / Contact Info -->
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: 35px 0 25px;">
                                <tr>
                                    <td style="text-align: center;">
                                        <h3 style="margin: 0 0 20px; color: #1a1a1a; font-size: 18px; font-weight: 600;">Need Immediate Assistance?</h3>
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                            <tr>
                                                <td style="padding: 12px; text-align: center;">
                                                    <a href="tel:' . str_replace(['-', ' ', '(', ')'], '', SITE_PHONE) . '" style="color: #667eea; font-size: 16px; font-weight: 600; text-decoration: none; display: inline-block;">
                                                        📞 ' . SITE_PHONE . '
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 12px; text-align: center;">
                                                    <a href="mailto:' . SITE_EMAIL . '" style="color: #667eea; font-size: 16px; font-weight: 600; text-decoration: none; display: inline-block;">
                                                        ✉️ ' . SITE_EMAIL . '
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            
                            <!-- Explore Products CTA -->
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: 30px 0;">
                                <tr>
                                    <td align="center" style="padding: 25px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 10px;">
                                        <h3 style="margin: 0 0 15px; color: #ffffff; font-size: 20px; font-weight: 600;">Explore Our Premium Products</h3>
                                        <p style="margin: 0 0 20px; color: rgba(255, 255, 255, 0.95); font-size: 15px; line-height: 1.6;">
                                            Discover our wide range of premium Indian spices, seeds, and powders while you wait.
                                        </p>
                                        <a href="' . BASE_URL . '/products" style="display: inline-block; background-color: #ffffff; color: #667eea; font-size: 16px; font-weight: 600; text-decoration: none; padding: 14px 35px; border-radius: 6px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);">
                                            View Products →
                                        </a>
                                    </td>
                                </tr>
                            </table>
                            
                            <!-- Closing -->
                            <p style="margin: 30px 0 0; color: #495057; font-size: 16px; line-height: 1.8;">
                                We appreciate your interest in ' . SITE_NAME . ' and look forward to serving you!
                            </p>
                            
                            <p style="margin: 20px 0 0; color: #495057; font-size: 16px; line-height: 1.8;">
                                Best regards,<br>
                                <strong style="color: #667eea;">The ' . SITE_NAME . ' Team</strong>
                            </p>
                            
                        </td>
                    </tr>
                    
                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f8f9fa; padding: 35px 40px; border-top: 1px solid #e9ecef;">
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                <tr>
                                    <td style="text-align: center; padding-bottom: 20px;">
                                        <h4 style="margin: 0 0 15px; color: #212529; font-size: 18px; font-weight: 600;">' . SITE_NAME . '</h4>
                                        <p style="margin: 0 0 8px; color: #6c757d; font-size: 14px; line-height: 1.6;">
                                            ' . SITE_ADDRESS . '
                                        </p>
                                        <p style="margin: 0 0 8px; color: #6c757d; font-size: 14px;">
                                            <a href="tel:' . str_replace(['-', ' ', '(', ')'], '', SITE_PHONE) . '" style="color: #667eea; text-decoration: none;">' . SITE_PHONE . '</a>
                                            | 
                                            <a href="mailto:' . SITE_EMAIL . '" style="color: #667eea; text-decoration: none;">' . SITE_EMAIL . '</a>
                                        </p>
                                        <p style="margin: 15px 0 0;">
                                            <a href="' . BASE_URL . '" style="color: #667eea; font-size: 13px; text-decoration: none; font-weight: 500;">Visit Our Website</a>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-top: 20px; border-top: 1px solid #e9ecef; text-align: center;">
                                        <p style="margin: 0; color: #adb5bd; font-size: 12px; line-height: 1.6;">
                                            This is an automated confirmation email. Please do not reply directly to this message.<br>
                                            If you have any questions, please contact us at <a href="mailto:' . SITE_EMAIL . '" style="color: #667eea; text-decoration: none;">' . SITE_EMAIL . '</a>
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    
                </table>
            </td>
        </tr>
    </table>
</body>
</html>';
    }
    
    public function certificates() {
        $pageData = [
            'title' => 'Certifications & Quality Standards | Mukta Exports - FSSAI, GMP, FDA Certified',
            'description' => 'Mukta Exports holds FSSAI, GMP, FDA, Spice Board, DGFT, GST, and MSME certifications. Our export documentation meets international food safety and quality standards for global trade.',
            'keywords' => 'FSSAI certified spices, GMP certified exporter, FDA approved spices India, Spice Board registered, DGFT registered exporter, quality certified spices, food safety standards',
            'og_image' => IMAGEKIT_CDN . '/export-hero.webp',
            'active_nav' => 'certificates',
            'structured_data' => $this->getLocalBusinessSchema() . $this->getBreadcrumbStructuredData(['Home', 'Certificates']),
        ];
        $config = $this->pageModel->getConfig();
        
        $this->view('pages/certificates', [
            'pageData' => $pageData,
            'config' => $config
        ]);
    }
    
    public function blog() {
        $pageData = [
            'title' => 'Spice Industry Insights & News | Mukta Exports Blog',
            'description' => 'Expert insights on Indian spice export industry, sourcing trends, packaging innovations, and private-label solutions. Stay updated with Mukta Exports\' spice trade knowledge.',
            'keywords' => 'spice industry blog, Indian spices news, spice export trends, private label spices, spice packaging, spice sourcing, turmeric benefits, cumin uses',
            'og_image' => IMAGEKIT_CDN . '/products/whole-spices.webp',
            'active_nav' => 'blog',
            'structured_data' => $this->getLocalBusinessSchema() . $this->getBlogStructuredData(),
        ];
        $config = $this->pageModel->getConfig();
        
        $this->view('pages/blog', [
            'pageData' => $pageData,
            'config' => $config
        ]);
    }
    
    public function blogDetail($slug) {
        // Map blog slugs to their data
        $blogPosts = [
            'why-world-loves-indian-spices' => [
                'title' => 'Why the World Loves Indian Spices: Heritage, Quality & Flavor | Mukta Exports',
                'description' => 'Discover why India is the "Land of Spices". Learn about the rich heritage, high curcumin turmeric, Malabar black pepper, and vibrant flavors that make Indian spices globally celebrated.',
                'keywords' => 'Indian spices, why Indian spices are best, turmeric benefits, curcumin content, Malabar pepper, spice sourcing India, premium spices, spice heritage',
                'published_date' => '2025-12-20',
                'article_title' => 'Unlocking the Essence of India: Why the World Loves Our Spices',
                'article_subtitle' => 'Discover the rich heritage, unmatched quality, and vibrant flavors that Mukta Exports brings to the global table.',
            ]
        ];
        
        if (!isset($blogPosts[$slug])) {
            $this->notFound();
            return;
        }
        
        $post = $blogPosts[$slug];
        
        $shareUrl = BASE_URL . '/blog/' . $slug;
        $shareTitle = urlencode($post['article_title']);
        $shareDescription = urlencode($post['description']);
        
        $pageData = [
            'title' => $post['title'],
            'description' => $post['description'],
            'keywords' => $post['keywords'],
            'og_image' => IMAGEKIT_CDN . '/products/whole-spices.webp',
            'og_type' => 'article',
            'active_nav' => 'blog',
            'is_blog_detail' => true,
            'published_date' => $post['published_date'],
            'article_title' => $post['article_title'],
            'article_subtitle' => $post['article_subtitle'],
            'share_url' => $shareUrl,
            'share_title' => $shareTitle,
            'share_description' => $shareDescription,
            'structured_data' => $this->getLocalBusinessSchema() . $this->getBlogArticleStructuredData($post, $slug),
        ];
        $config = $this->pageModel->getConfig();
        
        $this->view('blog/detail', [
            'pageData' => $pageData,
            'config' => $config,
            'post' => $post
        ]);
    }
    
    public function notFound() {
        http_response_code(404);
        $pageData = [
            'title' => '404 - Page Not Found | Mukta Exports',
            'description' => 'The page you are looking for could not be found.',
            'active_nav' => 'home',
        ];
        $config = $this->pageModel->getConfig();
        
        $this->view('pages/404', [
            'pageData' => $pageData,
            'config' => $config
        ]);
    }
    
    // Structured Data Helpers
    private function getHomeStructuredData() {
        return $this->getLocalBusinessSchema() . '
        <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "Organization",
          "name": "Mukta Exports",
          "alternateName": "Mukta Exports India",
          "url": "' . BASE_URL . '",
          "logo": "' . IMAGEKIT_CDN . '/muktalogo.svg",
          "description": "Premium Indian spices, seeds, and powders exporter based in Mumbai, India. FSSAI, GMP, and FDA certified.",
          "foundingDate": "2023",
          "address": {
            "@type": "PostalAddress",
            "streetAddress": "C/16, Beliram Industrial Estate, 1st Floor, S.V. Road",
            "addressLocality": "Dahisar East",
            "addressRegion": "Mumbai",
            "postalCode": "400068",
            "addressCountry": "IN"
          },
          "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "' . SITE_PHONE . '",
            "contactType": "sales",
            "email": "' . SITE_EMAIL . '",
            "availableLanguage": ["English", "Hindi"]
          },
          "sameAs": [],
          "areaServed": {
            "@type": "GeoCircle",
            "geoMidpoint": {
              "@type": "GeoCoordinates",
              "latitude": 19.2542,
              "longitude": 72.8568
            },
            "geoRadius": "50000"
          }
        }
        </script>
        <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "WebSite",
          "name": "Mukta Exports",
          "url": "' . BASE_URL . '",
          "description": "Premium Indian spices, seeds, and powders exporter",
          "publisher": {
            "@type": "Organization",
            "name": "Mukta Exports"
          }
        }
        </script>';
    }
    
    private function getLocalBusinessSchema() {
        return '
        <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "LocalBusiness",
          "@id": "' . BASE_URL . '/#business",
          "name": "Mukta Exports",
          "alternateName": "Mukta Exports India",
          "image": [
            "' . IMAGEKIT_CDN . '/export-hero.webp",
            "' . IMAGEKIT_CDN . '/muktalogo.svg"
          ],
          "logo": "' . IMAGEKIT_CDN . '/muktalogo.svg",
          "description": "Premium Indian spices, seeds, and powders exporter based in Mumbai, India. FSSAI, GMP, and FDA certified spice exporter serving global markets.",
          "priceRange": "$$",
          "telephone": "' . SITE_PHONE . '",
          "email": "' . SITE_EMAIL . '",
          "address": {
            "@type": "PostalAddress",
            "streetAddress": "C/16, Beliram Industrial Estate, 1st Floor, S.V. Road",
            "addressLocality": "Dahisar East",
            "addressRegion": "Maharashtra",
            "postalCode": "400068",
            "addressCountry": "IN"
          },
          "geo": {
            "@type": "GeoCoordinates",
            "latitude": 19.2542,
            "longitude": 72.8568
          },
          "openingHoursSpecification": [
            {
              "@type": "OpeningHoursSpecification",
              "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
              "opens": "09:00",
              "closes": "18:00"
            }
          ],
          "url": "' . BASE_URL . '",
          "sameAs": [],
          "servesCuisine": "Indian Spices",
          "hasOfferCatalog": {
            "@type": "OfferCatalog",
            "name": "Indian Spices, Seeds & Powders",
            "itemListElement": [
              {
                "@type": "OfferCatalog",
                "name": "Whole Spices",
                "url": "' . BASE_URL . '/products/spices"
              },
              {
                "@type": "OfferCatalog",
                "name": "Oil Seeds",
                "url": "' . BASE_URL . '/products/seeds"
              },
              {
                "@type": "OfferCatalog",
                "name": "Spice Powders",
                "url": "' . BASE_URL . '/products/powders"
              }
            ]
          },
          "areaServed": {
            "@type": "Country",
            "name": "Global"
          },
          "knowsAbout": [
            "Indian Spices Export",
            "Spice Sourcing",
            "Bulk Spice Supply",
            "FSSAI Certified Spices",
            "GMP Certified Exporter",
            "FDA Approved Spices"
          ]
        }
        </script>';
    }
    
    private function getAboutStructuredData() {
        return $this->getLocalBusinessSchema() . '
        <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "AboutPage",
          "name": "About Mukta Exports",
          "description": "Learn about Mukta Exports - India\'s trusted spice exporter. We connect global markets with premium Indian spices through ethical sourcing and quality control.",
          "url": "' . BASE_URL . '/about",
          "mainEntity": {
            "@type": "Organization",
            "name": "Mukta Exports",
            "founder": {
              "@type": "Person",
              "name": "Yash Ghaghda",
              "jobTitle": "Founder & Partner",
              "image": "' . IMAGEKIT_CDN . '/founder-image.webp"
            },
            "foundingDate": "2023",
            "description": "Premium Indian spices, seeds, and powders exporter based in Mumbai, India",
            "address": {
              "@type": "PostalAddress",
              "streetAddress": "C/16, Beliram Industrial Estate, 1st Floor, S.V. Road",
              "addressLocality": "Dahisar East",
              "addressRegion": "Mumbai",
              "postalCode": "400068",
              "addressCountry": "IN"
            }
          }
        }
        </script>
        ' . $this->getBreadcrumbStructuredData(['Home', 'About']);
    }
    
    private function getProductsStructuredData() {
        return $this->getLocalBusinessSchema() . '
        <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "CollectionPage",
          "name": "Premium Indian Spices, Seeds & Powders",
          "description": "Complete range of premium Indian spices, oil seeds, and spice powders from Mukta Exports",
          "url": "' . BASE_URL . '/products",
          "mainEntity": {
            "@type": "ItemList",
            "itemListElement": [
              {
                "@type": "ListItem",
                "position": 1,
                "name": "Whole Spices",
                "url": "' . BASE_URL . '/products/spices",
                "description": "Premium whole spices including turmeric, cardamom, cinnamon, clove, nutmeg, and more"
              },
              {
                "@type": "ListItem",
                "position": 2,
                "name": "Oil Seeds",
                "url": "' . BASE_URL . '/products/seeds",
                "description": "High-quality oil seeds including cumin, coriander, fennel, fenugreek, and mustard seeds"
              },
              {
                "@type": "ListItem",
                "position": 3,
                "name": "Spice Powders",
                "url": "' . BASE_URL . '/products/powders",
                "description": "Finely ground spice powders including turmeric, chilli, garam masala, and custom blends"
              }
            ]
          }
        }
        </script>
        ' . $this->getBreadcrumbStructuredData(['Home', 'Products']);
    }
    
    private function getContactStructuredData() {
        return $this->getLocalBusinessSchema() . '
        <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "ContactPage",
          "name": "Contact Mukta Exports",
          "description": "Contact Mukta Exports for premium Indian spices, seeds, and powders. Request quotes or inquire about bulk orders.",
          "url": "' . BASE_URL . '/contact",
          "mainEntity": {
            "@type": "Organization",
            "name": "Mukta Exports",
            "telephone": "' . SITE_PHONE . '",
            "email": "' . SITE_EMAIL . '",
            "address": {
              "@type": "PostalAddress",
              "streetAddress": "C/16, Beliram Industrial Estate, 1st Floor, S.V. Road",
              "addressLocality": "Dahisar East",
              "addressRegion": "Mumbai",
              "postalCode": "400068",
              "addressCountry": "IN"
            },
            "openingHoursSpecification": {
              "@type": "OpeningHoursSpecification",
              "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
              "opens": "09:00",
              "closes": "18:00"
            }
          }
        }
        </script>
        ' . $this->getBreadcrumbStructuredData(['Home', 'Contact']);
    }
    
    private function getBlogStructuredData() {
        return '
        <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "Blog",
          "name": "Mukta Exports Blog",
          "description": "Expert insights on Indian spice export industry, sourcing trends, and packaging innovations",
          "url": "' . BASE_URL . '/blog",
          "publisher": {
            "@type": "Organization",
            "name": "Mukta Exports",
            "logo": {
              "@type": "ImageObject",
              "url": "' . IMAGEKIT_CDN . '/muktalogo.svg"
            }
          }
        }
        </script>
        ' . $this->getBreadcrumbStructuredData(['Home', 'Blog']);
    }
    
    private function getBlogArticleStructuredData($post, $slug) {
        $url = BASE_URL . '/blog/' . $slug;
        return '
        <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "Article",
          "headline": "' . htmlspecialchars($post['article_title'], ENT_QUOTES, 'UTF-8') . '",
          "description": "' . htmlspecialchars($post['description'], ENT_QUOTES, 'UTF-8') . '",
          "image": "' . IMAGEKIT_CDN . '/products/whole-spices.webp",
          "author": {
            "@type": "Organization",
            "name": "Mukta Exports",
            "url": "' . BASE_URL . '"
          },
          "publisher": {
            "@type": "Organization",
            "name": "Mukta Exports",
            "logo": {
              "@type": "ImageObject",
              "url": "' . IMAGEKIT_CDN . '/muktalogo.svg"
            }
          },
          "datePublished": "' . $post['published_date'] . '",
          "dateModified": "' . $post['published_date'] . '",
          "mainEntityOfPage": {
            "@type": "WebPage",
            "@id": "' . $url . '"
          },
          "keywords": ["Indian spices", "turmeric", "curcumin", "Malabar pepper", "spice export"]
        }
        </script>
        ' . $this->getBreadcrumbStructuredData(['Home', 'Blog', $post['article_title']]);
    }
    
    private function getBreadcrumbStructuredData($items) {
        $breadcrumbs = [];
        $position = 1;
        $url = BASE_URL;
        
        foreach ($items as $item) {
            if ($item !== 'Home') {
                $url .= '/' . strtolower($item);
            }
            $breadcrumbs[] = [
                '@type' => 'ListItem',
                'position' => $position++,
                'name' => $item,
                'item' => $url
            ];
        }
        
        return '
        <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "BreadcrumbList",
          "itemListElement": ' . json_encode($breadcrumbs) . '
        }
        </script>';
    }
}
