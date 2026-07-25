# Shape and Color Records System

A web-based role management system for managing shape and color records, developed using **Laravel 13** as part of an internship technical assessment.

The system allows administrators to manage shape and color records through a CRUD interface, while users can view records in real time using a live data grid.

---

# Technologies Used

- Laravel 13
- PHP 8.4 or latest
- MySQL
- Bootstrap 5
- JavaScript (Fetch API)
- SweetAlert2
- HTML & CSS

---

# Tested Environment

This project was developed and tested using:

- Windows 11
- PHP 8.4
- MySQL (via XAMPP)
- Composer
- Node.js
- Laravel 13

> **Note:** The project was tested using XAMPP. However, any local development environment that supports **PHP 8.4+, MySQL, Composer, and Node.js** (e.g. Laragon, Herd, WAMP, or a standalone PHP/MySQL installation) can also be used.

---

# Features

## Login System

- Login as **Admin** or **User**
- Role-based authentication
- Username validation
- Password validation
- Show / Hide Password
- Logout

## Admin Portal

- Add new records
- Edit existing records
- Delete existing records
- Shape and colour dropdown selection
- Shape with colour preview
- Success and validation popup notifications
- Total records counter
- Automatic form switching (Submit → Update)

## User Portal

- View records
- Shape preview
- Total records counter
- Live data updates (every 5 seconds)
- Logout

---

# Installation Guide

## 1. Clone the repository

```bash
git clone https://github.com/kamaliah41/shape-and-color-records.git
```

Alternatively, download the project as a ZIP file and extract it.

---

## 2. Open the project folder

If using Git:

```bash
cd shape-and-color-records
```

If using the ZIP file, simply extract it and open the project folder using your preferred IDE or terminal.

---

## 3. Start your MySQL server

Start your local MySQL server (e.g. XAMPP, Laragon, WAMP, Herd, or MySQL Server).

---

## 4. Install PHP dependencies

```bash
composer install
```

---

## 5. Install Node.js dependencies

```bash
npm install
```

---

## 6. Create the environment file

Duplicate:

```
.env.example
```

Rename it to:

```
.env
```

---

## 7. Generate the application key

```bash
php artisan key:generate
```

---

## 8. Create the database

Create a MySQL database named:

```
intern_assessment_db
```

---

## 9. Import the database

Using phpMyAdmin or any MySQL client:

1. Select the **intern_assessment_db** database.
2. Click **Import**.
3. Select:

```
intern_assessment_db.sql
```

4. Click **Go**.

---

## 10. Configure the database connection

Open the `.env` file and update the following:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=intern_assessment_db
DB_USERNAME=root
DB_PASSWORD=
```

Update the username and password according to your local MySQL configuration if necessary.

Save the `.env` file after making the changes.

---

## 11. Clear Laravel cache

```bash
php artisan config:clear
php artisan cache:clear
```

---

## 12. Build frontend assets

```bash
npm run build
```

Wait until the build process completes successfully.

---

## 13. Start the application

```bash
php artisan serve
```

---

## 14. Open the application

Open your web browser and visit:

```
http://127.0.0.1:8000
```

---

# Default Login Credentials

The following accounts are preloaded in the provided database for testing purposes.

## Administrator

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

- Laravel Source Code
- README.md
- intern_assessment_db.sql

---

# Troubleshooting

### Unable to connect to the database?

- Ensure your MySQL server is running.
- Ensure the database name is **intern_assessment_db**.
- Verify the database credentials in the `.env` file.

Run the following commands:

```bash
php artisan config:clear
php artisan cache:clear
```

Then restart the application:

```bash
php artisan serve
```

---

# Notes

- This project was developed using Laravel 13 and MySQL.
- Composer and Node.js must be installed before running the application.
- Internet access is required to load Bootstrap 5 and SweetAlert2 from their CDN.
- The provided SQL file already contains the required user accounts and sample records for testing.

---

# Developed By

**Kamaliahnuruljannah Binti Azman**