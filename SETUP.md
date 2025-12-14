# Quick Setup Guide

## 🚀 Installation Steps

### 1. Upload Files
Upload all project files to your web server's document root directory.

### 2. Run Installation Script
1. Open your browser and go to: `http://yourdomain.com/install.php`
2. Follow the installation wizard
3. Enter your database credentials when prompted

### 3. Install Dependencies
Run this command in your project directory:
```bash
composer install
```

### 4. Configure Email (Optional)
Edit `config/config.php` and update the SMTP settings for email notifications:
```php
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_USERNAME', 'your-email@gmail.com');
define('SMTP_PASSWORD', 'your-app-password');
```

### 5. Customize Content
1. Login to admin panel: `http://yourdomain.com/admin/login.php`
2. Default credentials:
   - Username: `admin`
   - Password: `admin123`
3. Update your personal information, services, and portfolio

## 📁 File Structure
```
your-website/
├── admin/              # Admin panel
├── assets/             # CSS, JS, images
├── config/             # Configuration files
├── database/           # Database schema
├── includes/           # Shared PHP files
├── index.php          # Homepage
├── about.php          # About page
├── services.php       # Services page
├── portfolio.php      # Portfolio page
├── contact.php        # Contact page
├── install.php        # Installation script
└── README.md          # Full documentation
```

## 🎨 Customization

### Personal Information
1. Edit `config/config.php` to update site name and contact info
2. Replace placeholder images in `assets/images/`
3. Update the hero section text in `index.php`

### Styling
- Modify `assets/css/style.css` for custom colors and styles
- Update the gradient colors in the CSS variables section

### Content Management
- Use the admin panel to manage all content
- Add your services, portfolio projects, and testimonials
- View and respond to contact form messages

## 🔧 Technical Requirements

- **PHP:** 7.4 or higher
- **MySQL:** 5.7 or higher
- **Web Server:** Apache or Nginx
- **Extensions:** PDO, PDO_MySQL

## 🛡️ Security

1. **Change default admin password** immediately
2. **Delete install.php** after installation
3. **Set proper file permissions** (644 for files, 755 for directories)
4. **Use HTTPS** in production
5. **Regular backups** of your database

## 📱 Features Included

### Frontend
- ✅ Responsive homepage with hero section
- ✅ About page with skills and experience
- ✅ Services page with pricing
- ✅ Portfolio gallery with filtering
- ✅ Contact form with validation
- ✅ Mobile-friendly design

### Admin Panel
- ✅ Secure login system
- ✅ Dashboard with statistics
- ✅ Services management
- ✅ Portfolio management
- ✅ Testimonials management
- ✅ Messages management
- ✅ Real-time updates

### Technical
- ✅ PHP + MySQL backend
- ✅ Bootstrap 5 responsive design
- ✅ SweetAlert2 for notifications
- ✅ PHPMailer for emails
- ✅ Clean, maintainable code

## 🆘 Troubleshooting

### Common Issues

**Database Connection Error:**
- Check database credentials in `config/database.php`
- Ensure MySQL server is running
- Verify database exists

**Images Not Loading:**
- Check file paths in database
- Ensure images exist in `assets/images/`
- Check file permissions

**Email Not Working:**
- Verify SMTP settings in `config/config.php`
- Check if PHPMailer is installed (`composer install`)
- Test with a simple email first

**Admin Login Issues:**
- Check if admin user exists in database
- Try resetting password in database
- Clear browser cache and cookies

### Getting Help

1. Check the full `README.md` for detailed documentation
2. Verify all configuration settings
3. Check error logs in your web server
4. Ensure all dependencies are installed

## 🎯 Next Steps

1. **Customize** your content and images
2. **Add** your real portfolio projects
3. **Configure** email notifications
4. **Test** all functionality
5. **Deploy** to production
6. **Monitor** and maintain

---

**Need more help?** Check the full `README.md` file for comprehensive documentation and troubleshooting guides.