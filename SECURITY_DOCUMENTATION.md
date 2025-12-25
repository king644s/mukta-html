# Security Implementation Documentation
## Mukta Exports Website - .htaccess Security Configuration

This document explains all security measures implemented in the `.htaccess` file for the Mukta Exports website.

---

## Table of Contents
1. [HTTPS/SSL Enforcement](#1-httpsssl-enforcement)
2. [Security Headers](#2-security-headers)
3. [Directory Browsing Protection](#3-directory-browsing-protection)
4. [Sensitive File Protection](#4-sensitive-file-protection)
5. [Malicious User Agent Blocking](#5-malicious-user-agent-blocking)
6. [SQL Injection Protection](#6-sql-injection-protection)
7. [XSS Attack Prevention](#7-xss-attack-prevention)
8. [Request Method Restrictions](#8-request-method-restrictions)
9. [Hotlinking Protection](#9-hotlinking-protection)
10. [DoS Protection](#10-dos-protection)
11. [Custom Error Pages](#11-custom-error-pages)
12. [MIME Type Security](#12-mime-type-security)
13. [File Upload Security](#13-file-upload-security)
14. [Compression & Caching](#14-compression--caching)
15. [Additional Security Measures](#15-additional-security-measures)

---

## 1. HTTPS/SSL Enforcement

**What it does:**
- Automatically redirects all HTTP traffic to HTTPS
- Ensures all connections are encrypted
- Protects user data in transit

**Implementation:**
- Forces HTTPS for all requests
- Optional: Force www or non-www (currently commented out)

**Benefits:**
- Prevents man-in-the-middle attacks
- Improves SEO rankings
- Builds user trust
- Required for modern web standards

---

## 2. Security Headers

### X-Frame-Options
- **Purpose:** Prevents clickjacking attacks
- **Value:** `SAMEORIGIN` (allows framing from same domain only)

### X-XSS-Protection
- **Purpose:** Enables browser's built-in XSS filter
- **Value:** `1; mode=block`

### X-Content-Type-Options
- **Purpose:** Prevents MIME type sniffing
- **Value:** `nosniff`

### Referrer-Policy
- **Purpose:** Controls referrer information sent with requests
- **Value:** `strict-origin-when-cross-origin`

### Content-Security-Policy (CSP)
- **Purpose:** Prevents XSS, data injection, and other attacks
- **Current Configuration:**
  - Allows scripts from: self, Google Fonts, Google Tag Manager, ImageKit
  - Allows styles from: self, Google Fonts
  - Allows images from: self, ImageKit
  - Blocks inline scripts/styles (with exceptions for necessary resources)

### Permissions-Policy
- **Purpose:** Controls browser features and APIs
- **Current:** Blocks geolocation, microphone, camera

### Strict-Transport-Security (HSTS)
- **Purpose:** Forces browsers to use HTTPS for 1 year
- **Value:** `max-age=31536000; includeSubDomains; preload`

### Server Signature Removal
- **Purpose:** Hides server information from attackers
- Removes `X-Powered-By` header

---

## 3. Directory Browsing Protection

**What it does:**
- Prevents users from viewing directory contents
- Blocks access to file listings

**Implementation:**
- `Options -Indexes` - Disables directory listing
- `Options -MultiViews` - Disables content negotiation

**Benefits:**
- Prevents information disclosure
- Hides file structure from attackers
- Protects sensitive files

---

## 4. Sensitive File Protection

**Protected Files:**
- Hidden files (starting with `.`)
- Backup files (`.bak`, `.backup`, `.old`, `.orig`, `.save`, `.swp`, `.tmp`, `~`)
- Configuration files (`.conf`, `.dist`, `.env`)
- Log files (`.log`)
- Source control files (`.git`, `composer.json`, `package.json`)
- Documentation files (`README.md`, `CHANGELOG`, `LICENSE`)

**Implementation:**
- Blocks access via `<FilesMatch>` directives
- Returns 403 Forbidden for protected files

**Benefits:**
- Prevents information leakage
- Protects credentials and configuration
- Blocks access to backup files

---

## 5. Malicious User Agent Blocking

**Blocked User Agents:**
- Empty user agents
- User agents with special characters
- Known malicious tools: `curl`, `wget`, `python`, `nikto`, `nmap`, `sqlmap`
- Scrapers and bots (configurable)

**Implementation:**
- Uses `mod_rewrite` to check user agent strings
- Returns 403 Forbidden for blocked agents

**Benefits:**
- Prevents automated attacks
- Blocks scanning tools
- Reduces server load from bots

---

## 6. SQL Injection Protection

**What it blocks:**
- SQL keywords: `SELECT`, `UNION`, `INSERT`, `DELETE`, `UPDATE`, `REPLACE`, `CREATE`, `DROP`, `ALTER`, `EXEC`, `EXECUTE`
- SQL functions: `NULL`, `OUTFILE`, `LOAD_FILE`
- Suspicious patterns in query strings

**Implementation:**
- Analyzes query strings for SQL injection patterns
- Blocks requests with suspicious SQL-related content

**Benefits:**
- Prevents database attacks
- Protects against data theft
- Blocks unauthorized database access

---

## 7. XSS Attack Prevention

**What it blocks:**
- Script tags in query strings
- Iframe tags
- Object/embed tags
- Base64 encoded content
- JavaScript execution attempts

**Implementation:**
- Multiple layers of XSS protection:
  1. Content Security Policy (CSP) headers
  2. Query string filtering
  3. Request URI validation

**Benefits:**
- Prevents cross-site scripting attacks
- Protects user data
- Maintains site integrity

---

## 8. Request Method Restrictions

**Allowed Methods:**
- `GET` - Retrieve resources
- `POST` - Submit forms
- `HEAD` - Get headers only

**Blocked Methods:**
- `PUT`, `DELETE`, `TRACE`, `TRACK`, `OPTIONS`, `PATCH`

**Benefits:**
- Prevents unauthorized modifications
- Blocks dangerous HTTP methods
- Reduces attack surface

---

## 9. Hotlinking Protection

**What it does:**
- Prevents other websites from directly linking to your images
- Protects bandwidth and content

**Current Status:**
- Detection is enabled
- Blocking is commented out (can be enabled if needed)

**Options:**
1. Block hotlinking completely (return 403)
2. Redirect to placeholder image
3. Allow hotlinking (current state)

**To Enable Blocking:**
Uncomment the `RewriteRule` line in section 10 of `.htaccess`

---

## 10. DoS Protection

**Measures:**
- Limits request body size (10MB)
- Limits POST data size (1MB)
- Sets execution time limits (300 seconds)

**Implementation:**
- Uses `mod_security` if available
- PHP configuration limits

**Benefits:**
- Prevents denial of service attacks
- Protects server resources
- Maintains site availability

---

## 11. Custom Error Pages

**Configured Error Pages:**
- 400 Bad Request → `/404.html`
- 401 Unauthorized → `/404.html`
- 403 Forbidden → `/404.html`
- 404 Not Found → `/404.html`
- 500 Internal Server Error → `/404.html`
- 502 Bad Gateway → `/404.html`
- 503 Service Unavailable → `/404.html`

**Benefits:**
- Better user experience
- Hides server information
- Maintains brand consistency

---

## 12. MIME Type Security

**What it does:**
- Prevents execution of scripts in upload directories
- Sets proper MIME types for files
- Blocks PHP execution in assets folder

**Implementation:**
- Blocks `.php`, `.pl`, `.py`, `.jsp`, `.asp`, `.sh`, `.cgi` in `/assets/`
- Sets correct MIME types for web files

**Benefits:**
- Prevents code execution in upload directories
- Ensures proper file handling
- Blocks malicious file uploads

---

## 13. File Upload Security

**PHP Security Settings:**
- `allow_url_fopen` - Disabled
- `allow_url_include` - Disabled
- `display_errors` - Disabled (errors logged instead)
- `log_errors` - Enabled

**Benefits:**
- Prevents remote file inclusion attacks
- Hides error information from attackers
- Logs errors for debugging

**Note:** Update the error log path in `.htaccess` with your actual cPanel path.

---

## 14. Compression & Caching

### Compression (GZIP)
**Compressed File Types:**
- HTML, CSS, JavaScript
- XML, JSON, RSS
- Fonts (TTF, OTF, WOFF, WOFF2)
- SVG images

**Benefits:**
- Faster page loads
- Reduced bandwidth usage
- Better user experience

### Browser Caching
**Cache Durations:**
- Images: 1 year
- CSS/JS: 1 month
- HTML: No cache (always fresh)
- Fonts: 1 year

**Benefits:**
- Faster repeat visits
- Reduced server load
- Better performance scores

---

## 15. Additional Security Measures

### Directory Traversal Protection
- Blocks `../` patterns in URLs
- Prevents access to parent directories

### XML-RPC Protection
- Blocks `xmlrpc.php` and `wp-trackback.php` (if present)

### ETag Removal
- Removes ETags to prevent information disclosure
- Improves caching control

### Character Encoding
- Sets UTF-8 as default encoding
- Ensures proper character handling

### IP Blocking/Whitelisting
- Sections available for blocking specific IPs
- Sections available for allowing only specific IPs
- Currently commented out (enable if needed)

### Brute Force Protection
- Rate limiting configuration (requires `mod_evasive`)
- Currently commented out (enable if module available)

---

## Configuration Notes

### Before Deployment:
1. ✅ Test the `.htaccess` file on a staging environment
2. ✅ Verify all your pages still load correctly
3. ✅ Check that external resources (fonts, images, scripts) work
4. ✅ Update the error log path in PHP settings
5. ✅ Adjust CSP headers if you add new external resources
6. ✅ Update domain name in hotlinking rules if different
7. ✅ Enable/disable features based on your needs

### After Deployment:
1. ✅ Monitor error logs for blocked requests
2. ✅ Check website functionality regularly
3. ✅ Update security rules as needed
4. ✅ Keep Apache modules updated
5. ✅ Review blocked IPs/user agents periodically

### Customization:
- **CSP Headers:** Adjust if you add new CDNs or external scripts
- **Hotlinking:** Enable blocking if you want to prevent image theft
- **IP Blocking:** Add specific IPs to block if under attack
- **Error Pages:** Create custom error pages if desired
- **Cache Duration:** Adjust based on update frequency

---

## Required Apache Modules

For full functionality, ensure these modules are enabled:
- ✅ `mod_rewrite` - URL rewriting, redirects
- ✅ `mod_headers` - Security headers
- ✅ `mod_deflate` - Compression
- ✅ `mod_expires` - Browser caching
- ✅ `mod_mime` - MIME type handling
- ✅ `mod_security` - Advanced security (optional)
- ✅ `mod_evasive` - Rate limiting (optional)

**Check with your hosting provider if modules are available.**

---

## Testing Checklist

After deploying `.htaccess`, test:
- [ ] All pages load correctly
- [ ] HTTPS redirect works
- [ ] Images display properly
- [ ] CSS and JavaScript load
- [ ] Forms submit correctly
- [ ] External resources (fonts, analytics) work
- [ ] 404 page displays for missing pages
- [ ] No false positives in error logs

---

## Support & Maintenance

### Common Issues:

1. **500 Internal Server Error**
   - Check Apache error logs
   - Verify all modules are enabled
   - Check for syntax errors

2. **External Resources Blocked**
   - Update CSP headers
   - Add domains to allowed list

3. **Forms Not Working**
   - Verify POST method is allowed
   - Check file size limits

4. **Images Not Loading**
   - Check hotlinking rules
   - Verify MIME types

### Regular Maintenance:
- Review security logs monthly
- Update blocked IPs/user agents as needed
- Adjust CSP headers when adding new features
- Keep Apache and modules updated
- Monitor for new security threats

---

## Security Best Practices

1. **Keep Updated:** Regularly update security rules
2. **Monitor Logs:** Check error and access logs frequently
3. **Backup:** Always backup `.htaccess` before changes
4. **Test:** Test changes on staging before production
5. **Document:** Keep track of customizations
6. **Review:** Periodically review security measures
7. **Stay Informed:** Follow security news and updates

---

## Contact & Resources

For issues or questions:
- Check Apache error logs: `/home/username/logs/error_log`
- Check cPanel error logs
- Contact hosting provider for module availability
- Review Apache documentation for advanced configurations

---

**Last Updated:** 2024
**Version:** 1.0
**Maintained By:** Mukta Exports Development Team

