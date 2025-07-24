CREATE TABLE users (
                       user_id INT AUTO_INCREMENT PRIMARY KEY,
                       username VARCHAR(100) NOT NULL UNIQUE,
                       password VARCHAR(255) NOT NULL,
                       userprofile VARCHAR(255) DEFAULT 'default.jpg'
);

CREATE TABLE content (
                         id INT AUTO_INCREMENT PRIMARY KEY,
                         user_id INT,
                         name VARCHAR(100) NOT NULL,
                         content TEXT,
                         coffee_type VARCHAR(50),
                         temperature ENUM('Hot', 'Iced') DEFAULT 'Hot',
                         size ENUM('Small', 'Medium', 'Large') DEFAULT 'Medium',
                         sweeteners VARCHAR(100),
                         flavored VARCHAR(100),
                         img VARCHAR(255),
                         created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

                         FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);