Create Database IF NOT EXISTS careerconnect_db;

USE careerconnect_db;

CREATE TABLE users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(50) NOT NULL,
    full_name VARCHAR(255),
    email VARCHAR(255) UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE jobs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    jobTitle VARCHAR(255) NOT NULL,
    company VARCHAR(255) NOT NULL,
    location VARCHAR(255) NOT NULL,
    jobType VARCHAR(50) NOT NULL,
    salary VARCHAR(100) NULL,
    experience VARCHAR(50) NOT NULL,
    description TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE applications (
    application_id INT PRIMARY KEY AUTO_INCREMENT,
    job_id INT NOT NULL,
    cover_letter TEXT,
    resume_path VARCHAR(200),
    status VARCHAR(20) DEFAULT 'pending',
    applied_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    username VARCHAR(255),
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    experience TEXT,
    location VARCHAR(100),
    salary DECIMAL(10,2),
    Empname VARCHAR(255)
);

CREATE TABLE emp_details (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(100) NOT NULL UNIQUE,
    full_name VARCHAR(150) NOT NULL,
    email_address VARCHAR(150) NOT NULL UNIQUE,
    phone_number VARCHAR(50),
    education TEXT,
    skills TEXT,
    experience TEXT,
    location VARCHAR(150),
    website VARCHAR(150),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE company_details (
    company_id INT PRIMARY KEY AUTO_INCREMENT,
    full_name VARCHAR(244),
    industry VARCHAR(100),
    company_size VARCHAR(50),
    founded YEAR(4),
    email_address VARCHAR(255),
    phone_number VARCHAR(20),
    website VARCHAR(255),
    location VARCHAR(255),
    username VARCHAR(255)
);
