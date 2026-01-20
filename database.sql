-- Create Database
CREATE DATABASE IF NOT EXISTS event_system;
USE event_system;

-- Create Events Table
CREATE TABLE IF NOT EXISTS events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description LONGTEXT NOT NULL,
    date DATE NOT NULL,
    time TIME NOT NULL,
    location VARCHAR(255) NOT NULL,
    max_participants INT NOT NULL DEFAULT 100,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_date (date),
    INDEX idx_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create Registrations Table
CREATE TABLE IF NOT EXISTS registrations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    registered_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (event_id) REFERENCES events(id) ON DELETE CASCADE,
    INDEX idx_event_id (event_id),
    INDEX idx_email (email),
    INDEX idx_registered_at (registered_at),
    UNIQUE KEY unique_event_email (event_id, email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create Admin Table
CREATE TABLE IF NOT EXISTS admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_username (username)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert Demo Admin User (username: admin, password: admin123)
INSERT INTO admin (username, password) VALUES 
('admin', '$2y$12$79.mKtrW.s70Rqq5kXMz7upTpLaYsu863u8Qj40f6gZYg97A6tDQy');

-- Insert Sample Events
INSERT INTO events (title, description, date, time, location, max_participants) VALUES 
('Web Development Workshop', 'Learn modern web development with HTML, CSS, and JavaScript. Perfect for beginners and intermediate developers looking to enhance their skills.', DATE_ADD(CURDATE(), INTERVAL 10 DAY), '14:00:00', 'Tech Hub, Lahore', 50),
('PHP CodeIgniter Bootcamp', 'Comprehensive bootcamp on CodeIgniter 4 framework covering MVC architecture, database operations, and building production-ready applications.', DATE_ADD(CURDATE(), INTERVAL 15 DAY), '10:00:00', 'Digital Innovation Center, Karachi', 30),
('Mobile App Development', 'Learn to build iOS and Android apps using React Native. Hands-on training with real-world projects.', DATE_ADD(CURDATE(), INTERVAL 20 DAY), '16:00:00', 'Innovation Hub, Islamabad', 40),
('Data Science & AI Summit', 'Explore machine learning, deep learning, and artificial intelligence trends. Network with industry experts.', DATE_ADD(CURDATE(), INTERVAL 25 DAY), '09:00:00', 'Convention Center, Lahore', 100),
('Cloud Computing with AWS', 'Master cloud infrastructure with Amazon Web Services. Learn EC2, S3, Lambda, and more.', DATE_ADD(CURDATE(), INTERVAL 5 DAY), '13:00:00', 'Tech Park, Islamabad', 35),
('Digital Marketing Masterclass', 'SEO, SEM, Social Media Marketing, and Content Strategy. A complete guide to digital marketing.', DATE_ADD(CURDATE(), INTERVAL 12 DAY), '15:00:00', 'Business Center, Karachi', 60);
