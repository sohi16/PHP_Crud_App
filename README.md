# Project Title

Brief description of your PHP-MySQL project.

## Table of Contents

- [Introduction](#introduction)
- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
- [Contributing](#contributing)

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
     CREATE TABLE IF NOT EXISTS `users` (
       `User_Id` INT PRIMARY KEY AUTO_INCREMENT,
       `First_Name` VARCHAR(255) NOT NULL,
       `Last_Name` VARCHAR(255) NOT NULL,
       `Email` VARCHAR(255) NOT NULL,
       `Image` VARCHAR(255) NOT NULL,
       `Country` VARCHAR(255) NOT NULL,
       `Gender` VARCHAR(255) NOT NULL,
     );

     CREATE TABLE IF NOT EXISTS `admin_login` (
       `Admin_Id` INT PRIMARY KEY AUTO_INCREMENT,
       `Admin_Name` VARCHAR(255) NOT NULL,
       `Admin_Password` VARCHAR(255) NOT NULL,
     );
     
     ```

3. **Database Configuration:**

   - Open `dbcon.php` and provide your database configuration.
   - Save the file as `dbcon.php`.

   ```php
   <?php
   dbcon.php
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "php_crud";

## XAMPP Configuration:

   Ensure that XAMPP is running, and Apache and MySQL servers are started.

## Usage

   Access the project in browser using:
   http://localhost/crud-app/index.php 

## If you would like to contribute to the project, follow these steps:

Fork the project.
Create a new branch: git checkout -b feature-name.
Make your changes and commit them: git commit -m 'Add feature'.
Push to the branch: git push origin feature-name.
Submit a pull request.


