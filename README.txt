STUDORA — Student Management System
=================================
Frontend: HTML, CSS, JavaScript
Backend: PHP (PDO)
Database: MySQL

RUN LOCALLY WITH WAMP/XAMPP
1. Copy the studora folder to your server web directory (WAMP www or XAMPP htdocs).
2. Start Apache and MySQL.
3. Open phpMyAdmin.
4. Import database.sql from this project.
5. If needed, edit backend/db.php for your MySQL username/password.
6. Visit http://localhost/studora/index.html
7. Use Get started to register. Then login and view dashboard.

NOTES
- Do not use PHP's built-in password storage as plain text; password_hash and password_verify are used.
- This is a starter project. Add CSRF protection, rate limiting, email verification, roles/permissions, and more robust error logging before production deployment.
- Student listing, CRUD, attendance, and course management are planned extension modules.
