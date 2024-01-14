# Project Title

Brief description of your PHP-MySQL project.

## Table of Contents

- [Introduction](#introduction)
- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
- [Contributing](#contributing)
- [License](#license)

## Introduction

I have developed a PHP MySQL CRUD application to perform operations like insert, select, update, delete without reloading the page i.e using ajax with a admin login form.

## Prerequisites

Before you begin, ensure you have met the following requirements:

- [XAMPP](https://www.apachefriends.org/index.html) installed on your local machine.
- Basic understanding of PHP and MySQL.

## Installation

1. Clone the repository:

   ```bash
   git https://github.com/sohi16/PHP_Crud_App.git
   
2. Navigate to the project directory:

   cd PHP_Crud_App
   
## Database Setup

1. **Create Database:**

   Open your MySQL database management tool (e.g., phpMyAdmin).
   Create a new database named `php_crud`.

2. **Create Tables:**

   - Run the following SQL script to create the required tables:

     ```sql
     -- Example SQL script
     CREATE TABLE IF NOT EXISTS `users` (
       `id` INT PRIMARY KEY AUTO_INCREMENT,
       `username` VARCHAR(255) NOT NULL,
       `email` VARCHAR(255) NOT NULL,
       -- Add other columns as needed
     );

     -- Add more tables if necessary
     ```

   - Make sure to customize the table structure based on your project requirements.

3. **Database Configuration:**

   - Open `config/db_sample.php` and provide your database configuration.
   - Save the file as `config/db.php`.

   ```php
   <?php
   // config/db.php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'your_database_user');
   define('DB_PASSWORD', 'your_database_password');
   define('DB_NAME', 'your_database_name');
