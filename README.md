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

## 📁 Project Structure
├── README.md # Project documentation
├── add.php # Add a new note
├── db.php # Database connection file
├── delete.php # Delete a note
├── edit.php # Edit an existing note
├── index.php # Home/dashboard showing all notes
├── login.php # User login
├── logout.php # User logout
├── register.php # User registration
├── search.php # Search notes


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
