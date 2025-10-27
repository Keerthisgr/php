CREATE DATABASE student_portal;
USE student_portal;

-- Admin table
CREATE TABLE admin (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Students table
CREATE TABLE students (
    id INT PRIMARY KEY AUTO_INCREMENT,
    full_name VARCHAR(100) NOT NULL,
    student_id VARCHAR(20) UNIQUE NOT NULL,
    gender ENUM('Male', 'Female', 'Other') NOT NULL,
    address TEXT NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone VARCHAR(15) NOT NULL,
    blood_group VARCHAR(5) NOT NULL,
    admission_date DATE NOT NULL,
    course ENUM('BE', 'M Tech', 'BSc', 'MSc') NOT NULL,
    subject ENUM('CSE', 'EC', 'EEE', 'ME', 'IS') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- username-admin password-admin123
INSERT INTO admin (username, password, email) 
VALUES ('admin', 'admin123', 'admin@studentportal.com');