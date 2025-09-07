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



INSERT INTO users (username, password, role, full_name, email) VALUES
('nimal_perera', 'pass123', 'USER', 'Nimal Perera', 'nimal.perera@gmail.com'),
('sajith_kumara', 'pass123', 'USER', 'Sajith Kumara', 'sajith.kumara@yahoo.com'),
('tharindu_silva', 'pass123', 'USER', 'Tharindu Silva', 'tharindu.silva@hotmail.com'),
('kamal_fernando', 'pass123', 'USER', 'Kamal Fernando', 'kamal.fernando@gmail.com'),
('dinithi_jayasinghe', 'pass123', 'USER', 'Dinithi Jayasinghe', 'dinithi.jayasinghe@gmail.com'),
('isuru_bandara', 'pass123', 'USER', 'Isuru Bandara', 'isuru.bandara@yahoo.com'),
('gayani_rathnayake', 'pass123', 'USER', 'Gayani Rathnayake', 'gayani.rathnayake@gmail.com'),
('lasith_gunawardena', 'pass123', 'USER', 'Lasith Gunawardena', 'lasith.gunawardena@gmail.com');


INSERT INTO users (username, password, role, full_name, email) VALUES
('dialog_ax', 'pass123', 'Company', 'Dialog Axiata PLC', 'info@dialog.lk'),
('hnb_bank', 'pass123', 'Company', 'Hatton National Bank', 'careers@hnb.lk'),
('keells_holdings', 'pass123', 'Company', 'Keells Holdings PLC', 'jobs@keells.com'),
('singer_lanka', 'pass123', 'Company', 'Singer Sri Lanka', 'contact@singersl.com'),
('virtusa_lk', 'pass123', 'Company', 'Virtusa Sri Lanka', 'jobs@virtusa.com'),
('lolc_finance', 'pass123', 'Company', 'LOLC Finance PLC', 'careers@lolc.com'),
('brandix_lk', 'pass123', 'Company', 'Brandix Apparel Ltd', 'hr@brandix.com'),
('mas_holdings', 'pass123', 'Company', 'MAS Holdings', 'info@masholdings.com');

INSERT INTO company_details (username, full_name, email_address, industry, company_size, founded, phone_number, website, location) VALUES
('dialog_ax', 'Dialog Axiata PLC', 'info@dialog.lk', 'Telecommunications', '5000+', '1995', '011-7007000', 'www.dialog.lk', 'Colombo'),
('hnb_bank', 'Hatton National Bank', 'careers@hnb.lk', 'Banking & Finance', '3000+', '1888', '011-2664664', 'www.hnb.net', 'Colombo'),
('keells_holdings', 'Keells Holdings PLC', 'jobs@keells.com', 'Retail', '2500+', '1870', '011-2303500', 'www.keells.com', 'Colombo'),
('singer_lanka', 'Singer Sri Lanka', 'contact@singersl.com', 'Retail & Electronics', '2000+', '1877', '011-5405405', 'www.singersl.com', 'Colombo'),
('virtusa_lk', 'Virtusa Sri Lanka', 'jobs@virtusa.com', 'Software & IT', '6000+', '1996', '011-2165000', 'www.virtusa.com', 'Colombo'),
('lolc_finance', 'LOLC Finance PLC', 'careers@lolc.com', 'Finance', '4000+', '1980', '011-5880880', 'www.lolcfinance.com', 'Rajagiriya'),
('brandix_lk', 'Brandix Apparel Ltd', 'hr@brandix.com', 'Garments & Apparel', '35000+', '1969', '011-4742000', 'www.brandix.com', 'Katunayake'),
('mas_holdings', 'MAS Holdings', 'info@masholdings.com', 'Apparel & Textiles', '90000+', '1987', '011-4722000', 'www.masholdings.com', 'Colombo');


INSERT INTO emp_details (username, full_name, email_address, phone_number, education, skills, experience, location, website) VALUES
('nimal_perera', 'Nimal Perera', 'nimal.perera@gmail.com', '077-1234567', 'BSc IT - University of Colombo', 'Java, SQL, PHP', '2 years Software Developer', 'Colombo', 'linkedin.com/in/nimalperera'),
('sajith_kumara', 'Sajith Kumara', 'sajith.kumara@yahoo.com', '071-2233445', 'BSc Computer Science - University of Peradeniya', 'Python, Django, React', '1 year Web Developer', 'Kandy', 'github.com/sajithkumara'),
('tharindu_silva', 'Tharindu Silva', 'tharindu.silva@hotmail.com', '076-5544332', 'BSc Engineering - University of Moratuwa', 'C++, Java, Spring Boot', 'Intern at Virtusa', 'Moratuwa', 'portfolio.com/tharindusilva'),
('kamal_fernando', 'Kamal Fernando', 'kamal.fernando@gmail.com', '075-9876543', 'BIT - UCSC', 'HTML, CSS, JS', 'Freelance Frontend Dev', 'Galle', 'linkedin.com/in/kamalfernando'),
('dinithi_jayasinghe', 'Dinithi Jayasinghe', 'dinithi.jayasinghe@gmail.com', '072-4455667', 'BBA in IT - University of Kelaniya', 'Project Mgmt, SQL', '2 years Business Analyst', 'Kurunegala', 'linkedin.com/in/dinithij'),
('isuru_bandara', 'Isuru Bandara', 'isuru.bandara@yahoo.com', '078-2233111', 'Diploma in IT - NIBM', 'PHP, Laravel, MySQL', '1 year Backend Developer', 'Matara', 'github.com/isurubandara'),
('gayani_rathnayake', 'Gayani Rathnayake', 'gayani.rathnayake@gmail.com', '077-9988776', 'BSc Computer Science - SLIIT', 'UI/UX, Figma, React', 'Intern UI Designer', 'Colombo', 'dribbble.com/gayanir'),
('lasith_gunawardena', 'Lasith Gunawardena', 'lasith.gunawardena@gmail.com', '070-6677889', 'BSc Data Science - University of Colombo', 'Python, R, SQL', 'Research Assistant', 'Colombo', 'linkedin.com/in/lasithg');
