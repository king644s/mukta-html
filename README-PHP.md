# Mukta Exports - PHP Website

Premium Indian Spices, Seeds & Powders Exporter Website

## 🚀 Quick Start

### Prerequisites
- PHP 7.4 or higher
- PHP CLI (Command Line Interface)

### Starting the Development Server

**Option 1: Using the start script (Recommended)**
```bash
chmod +x start-server.sh
./start-server.sh
```

**Option 2: Direct PHP command**
```bash
php -S localhost:8000 router.php
```

**Option 3: Custom port**
```bash
php -S localhost:8080 router.php
```

The server will be available at: **http://localhost:8000**

### Stopping the Server
Press `Ctrl+C` in the terminal where the server is running.

---

## 🔍 Testing Canonical Tags

### Method 1: Automated Checker Script

1. **Start the PHP server** (in one terminal):
   ```bash
   php -S localhost:8000 router.php
   ```

2. **Run the checker** (in another terminal):
   ```bash
   php check-canonical.php
   ```

This will automatically check all pages and report any canonical tag issues.

### Method 2: Manual Browser Check

1. **Start the server**:
   ```bash
   php -S localhost:8000 router.php
   ```

2. **Open your browser** and navigate to any page (e.g., `http://localhost:8000/products/spices`)

3. **View Page Source** (Right-click → View Page Source, or `Cmd+Option+U` on Mac / `Ctrl+U` on Windows)

4. **Search for "canonical"** (`Cmd+F` / `Ctrl+F`)

5. **Verify the canonical tag** looks like:
   ```html
   <link rel="canonical" href="http://localhost:8000/products/spices" />
   ```
   
   The URL should match exactly the page you're viewing.

### Method 3: Browser Developer Tools

1. **Open Developer Tools** (`F12` or `Cmd+Option+I`)

2. **Go to Elements/Inspector tab**

3. **Search for `<link rel="canonical">`** in the HTML

4. **Check the `href` attribute** - it should match the current page URL

### Method 4: Online Tools

1. **Start your server** and make it accessible (or use ngrok for local testing)

2. **Use Google's Rich Results Test**:
   - https://search.google.com/test/rich-results
   - Enter your page URL
   - Check for canonical tag

3. **Use SEO checker tools**:
   - https://www.seoreviewtools.com/canonical-url-checker/
   - Enter your page URL and check results

---

## 📋 Pages to Test

Test these pages to verify canonical tags:

- `/` - Homepage
- `/about` - About page
- `/products` - Products listing
- `/products/spices` - Spices category
- `/products/seeds` - Seeds category
- `/products/powders` - Powders category
- `/products/spices/turmeric` - Product detail page
- `/products/seeds/cumin-seeds` - Product detail page
- `/contact` - Contact page
- `/certificates` - Certificates page
- `/blog` - Blog page

---

## ✅ What to Look For

**✅ Correct Canonical Tag:**
```html
<link rel="canonical" href="http://localhost:8000/products/spices" />
```

**❌ Wrong Canonical Tag (points to different page):**
```html
<link rel="canonical" href="http://localhost:8000/products" />
```

**❌ Missing Canonical Tag:**
No `<link rel="canonical">` tag found in the page source.

---

## 🌐 Production Deployment

For production, ensure:

1. **HTTPS is enabled** - Canonical URLs will automatically use HTTPS
2. **Domain is set correctly** - The canonical URL will use your production domain
3. **No trailing slashes** (except homepage) - The system handles this automatically
4. **Test in Google Search Console** after deployment

---

## 🐛 Troubleshooting

### Server won't start
- Check if port 8000 is already in use: `lsof -i :8000`
- Use a different port: `php -S localhost:8080 router.php`

### Canonical tags not showing
- Make sure you're viewing the page source, not inspecting elements
- Check browser cache - try hard refresh (`Cmd+Shift+R` / `Ctrl+Shift+F5`)
- Verify the server is running and accessible

### Canonical URL is wrong
- Check `app/config/config.php` - the `getCanonicalUrl()` function should be working
- Verify `$_SERVER['REQUEST_URI']` is correct
- Check for any URL rewriting issues

---

## 📞 Support

If you encounter issues, check:
1. PHP version: `php -v` (should be 7.4+)
2. Server logs in the terminal
3. Browser console for JavaScript errors
4. Network tab in Developer Tools

