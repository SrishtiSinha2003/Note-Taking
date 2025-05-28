# 📝 Note-Taking Web App

A simple web-based Note-Taking application built using **PHP** and **MySQL**. This app allows users to register, log in, create, edit, delete, and search for notes. It’s designed to demonstrate basic CRUD operations, session handling, and user authentication.

## 🚀 Features

- 🔐 User Authentication (Register/Login/Logout)
- ➕ Add Notes
- ✏️ Edit Notes
- ❌ Delete Notes
- 🔍 Search Notes
- 📦 MySQL Database Integration
- 🖥️ Simple and Clean Interface

## 🛠️ Tech Stack

- **Frontend:** HTML, CSS
- **Backend:** PHP
- **Database:** MySQL

## 🛠️ Requirements
- PHP 7.x or later

- MySQL or MariaDB

- A local server (e.g., XAMPP, WAMP, or MAMP)



## 📁 Project Structure

Note-Taking/ <br>
├── README.md           # Project documentation <br>
├── add.php             # Add a new note<br>
├── db.php              # Database connection file<br>
├── delete.php          # Delete a note<br>
├── edit.php            # Edit an existing note<br>
├── index.php           # Home/dashboard showing all notes<br>
├── login.php           # User login<br>
├── logout.php          # User logout<br>
├── register.php        # User registration<br>
└── search.php          # Search notes<br>




---

## 🛠️ Set Up the Database

1. Create a MySQL database named `notes_app`.
2. Run the following SQL statements:

```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE notes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(100),
    content TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);


    title VARCHAR(100),
    content TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);


## ⚙️ Configuration

To configure the database connection, open `db.php` and update your MySQL credentials:

```php
<?php
$host = 'localhost';
$db   = 'notes_app';
$user = 'root';
$pass = '';

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

