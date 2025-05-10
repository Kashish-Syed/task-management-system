-- Users table
CREATE TABLE users (
    id int AUTO_INCREMENT PRIMARY KEY,
    full_name varchar(50) NOT NULL,
    username varchar(50) NOT NULL,
    password varchar(255) NOT NULL,
    role ENUM('admin', 'employee') NOT NULL,
    created_at timestamp DEFAULT CURRENT_TIMESTAMP
);

-- Tasks table
CREATE TABLE tasks (
    id int AUTO_INCREMENT PRIMARY KEY,
    title varchar(100) NOT NULL,
    description TEXT,
    assigned_to INT,
    status ENUM('pending', 'in_progress', 'completed') DEFAULT 'pending',
    created_at timestamp DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (assigned_to) REFERENCES users(id)
);
