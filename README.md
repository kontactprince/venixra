# Personal Freelancing Website

A dynamic, responsive personal freelancing website built with PHP, MySQL, and Bootstrap. Features a complete admin panel for managing content and a modern, mobile-friendly design.

## Features

### Frontend
- **Homepage** with hero section, services preview, portfolio showcase, and testimonials
- **About Page** with skills, experience timeline, and resume download
- **Services Page** with dynamic service listings and pricing plans
- **Portfolio Page** with project gallery and filtering
- **Contact Page** with contact form and social media links
- **Responsive Design** that works on all devices
- **Modern UI** with Bootstrap 5 and custom CSS

### Admin Panel
- **Secure Authentication** with login/logout functionality
- **Dashboard** with statistics and quick actions
- **Services Management** - Add, edit, delete services
- **Portfolio Management** - Manage projects with images and links
- **Testimonials Management** - Add and manage client testimonials
- **Messages Management** - View and manage contact form submissions
- **Real-time Updates** - Changes reflect immediately on the website

### Technical Features
- **PHP 7.4+** with PDO for database operations
- **MySQL Database** with proper schema and relationships
- **PHPMailer Integration** for email notifications
- **SweetAlert2** for beautiful alerts and confirmations
- **Bootstrap 5** for responsive design
- **Font Awesome** for icons
- **Clean Code** with proper separation of concerns

## Installation

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web server (Apache/Nginx)
- Composer (for PHPMailer)

### Setup Instructions

1. **Clone or download the project files**
   ```bash
   git clone <repository-url>
   cd personal-freelancing-website
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Database Setup**
   - Create a MySQL database named `freelancing_website`
   - Import the database schema:
   ```bash
   mysql -u username -p freelancing_website < database/schema.sql
   ```

4. **Configuration**
   - Update `config/database.php` with your database credentials
   - Update `config/config.php` with your site information and email settings
   - Configure SMTP settings for email notifications

5. **File Permissions**
   - Ensure the web server has read/write access to the project directory
   - Make sure `assets/uploads/` directory is writable (if you plan to add file uploads)

6. **Web Server Setup**
   - Point your web server document root to the project directory
   - Ensure mod_rewrite is enabled (for clean URLs)

### Default Admin Credentials
- **Username:** admin
- **Email:** admin@example.com
- **Password:** admin123

**Important:** Change these credentials immediately after installation!

## Configuration

### Database Configuration
Edit `config/database.php`:
```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'freelancing_website');
define('DB_USER', 'your_username');
define('DB_PASS', 'your_password');
```

### Site Configuration
Edit `config/config.php`:
```php
define('SITE_NAME', 'Your Name - Freelance Developer');
define('SITE_URL', 'http://yourdomain.com');
define('ADMIN_EMAIL', 'your-email@example.com');
```

### Email Configuration
For PHPMailer to work, update the SMTP settings in `config/config.php`:
```php
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_USERNAME', 'your-email@gmail.com');
define('SMTP_PASSWORD', 'your-app-password');
define('SMTP_FROM_EMAIL', 'your-email@gmail.com');
define('SMTP_FROM_NAME', 'Your Name');
```

## Usage

### Admin Panel Access
1. Navigate to `yourdomain.com/admin/login.php`
2. Use the default credentials (change them after first login)
3. Manage your website content through the admin panel

### Adding Content
1. **Services:** Add your services with descriptions and pricing
2. **Portfolio:** Upload project images and add project details
3. **Testimonials:** Add client testimonials with ratings
4. **Messages:** View and respond to contact form submissions

### Customization
1. **Personal Information:** Update your name, contact info, and bio
2. **Colors and Styling:** Modify `assets/css/style.css`
3. **Content:** Update text content in the PHP files
4. **Images:** Replace placeholder images with your own

## File Structure

```
project/
├── admin/                  # Admin panel files
│   ├── login.php
│   ├── dashboard.php
│   ├── services.php
│   ├── portfolio.php
│   ├── testimonials.php
│   ├── messages.php
│   └── logout.php
├── assets/                 # Static assets
│   ├── css/
│   │   └── style.css
│   ├── js/
│   │   └── script.js
│   └── images/
├── config/                 # Configuration files
│   ├── config.php
│   └── database.php
├── database/               # Database files
│   └── schema.sql
├── includes/               # Shared PHP files
│   ├── header.php
│   ├── footer.php
│   └── functions.php
├── index.php              # Homepage
├── about.php              # About page
├── services.php           # Services page
├── portfolio.php          # Portfolio page
├── contact.php            # Contact page
├── process_contact.php    # Contact form handler
├── composer.json          # Composer dependencies
└── README.md             # This file
```

## Security Features

- **Password Hashing:** Admin passwords are securely hashed
- **SQL Injection Protection:** All database queries use prepared statements
- **Input Sanitization:** All user inputs are sanitized
- **Session Management:** Secure session handling
- **CSRF Protection:** CSRF tokens for forms (can be implemented)

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers

## Troubleshooting

### Common Issues

1. **Database Connection Error**
   - Check database credentials in `config/database.php`
   - Ensure MySQL server is running
   - Verify database exists

2. **Email Not Working**
   - Check SMTP settings in `config/config.php`
   - Verify email credentials
   - Check if PHPMailer is installed (`composer install`)

3. **Images Not Loading**
   - Check file paths in database
   - Ensure images exist in the specified locations
   - Check file permissions

4. **Admin Login Issues**
   - Verify database connection
   - Check if admin user exists in database
   - Try resetting password in database

### Getting Help

If you encounter issues:
1. Check the error logs
2. Verify all configuration settings
3. Ensure all dependencies are installed
4. Check file permissions

## License

This project is open source and available under the MIT License.

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## Support

For support, please contact [your-email@example.com] or create an issue in the repository.

---

**Note:** This is a template project. Remember to customize all placeholder content, images, and personal information before deploying to production.