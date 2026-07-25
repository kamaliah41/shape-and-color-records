# Shape and Color Records System

A web-based role management system about shape and color records, developed using **Laravel 13** as part of an internship technical assessment.

It allows admin to manage shape and color records while users can view records in real time through a live data grid.

## Technologies Used

- Laravel 13
- PHP 8.4
- MySQL
- Bootstrap 5
- JavaScript (Fetch API)
- SweetAlert2
- HTML & CSS

## Tested Environment

The project has been successfully tested using:

- Windows 11
- XAMPP
- PHP 8.4
- MySQL
- Composer
- Node.js
- Laravel 13

## List of Features:

### Login System
- Login as **Admin** or **User**
- Role-based authentication
- Username validation
- Password validation
- Show / Hide password
- Logout

### Admin Portal
- Add new records
- Edit existing records
- Delete records
- Shape & color dropdown selection
- Shape with color preview
- Success popup notifications
- Total records counter
- Automatic form switching (Submit → Update)

### User Portal
- View records
- Shape preview
- Total records counter
- Live data updates (every 5 seconds)
- Logout

---

# Installation Guide:

## 1. Clone the repository

```bash
git clone https://github.com/kamaliah41/shape-and-color-records.git
```

or download the ZIP file.

---

## 2. Open the project

```bash
cd shape-and-color-records
```

---

## 3. Install PHP dependencies

```bash
composer install
```

---

## 4. Install Node dependencies

```bash
npm install
```

---

## 5. Create environment file

Duplicate

```
.env.example
```

Rename it to

```
.env
```

---

## 6. Generate application key

```bash
php artisan key:generate
```

---

## 7. Create MySQL database

Create a database named

```
intern_assessment_db
```

---

## 8. Import database

Import the provided SQL file

```
intern_assessment_db.sql
```

using phpMyAdmin.

---

## 9. Configure database

Update the following inside `.env`

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=intern_assessment_db
DB_USERNAME=root
DB_PASSWORD=
```

Modify the username and password according to your local MySQL configuration if required.

---

## 10. Build frontend assets

```bash
npm run build
```

---

## 11. Run the application

```bash
php artisan serve
```

---

## 12. Open the application

```
http://127.0.0.1:8000
```

---

# Default Login Credentials

## Admin

| Username | Password |
|----------|----------|
| admin1 | 111222 |

## Users

| Username | Password |
|----------|----------|
| user1 | 333444 |
| user2 | 555666 |

---


# Project Files Included

- Source Code
- README.md
- intern_assessment_db.sql

---

# Notes

- Developed using Laravel 13 and MySQL.
- Database connection can be modified through the `.env` file.
- Internet connection is required to load Bootstrap and SweetAlert2 CDN resources.
- The application has been tested locally using XAMPP.

## If the application cannot connect to the database:

- Ensure MySQL service is running.

- Ensure the database name is: intern_assessment_db

- Verify your .env database credentials.

- Run

- php artisan config:clear

- php artisan cache:clear

- restart the application.

---

# Developed by:

**Kamaliahnuruljannah Azman**