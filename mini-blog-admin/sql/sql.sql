-- Create the users table
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL DEFAULT,
    password VARCHAR(255) NOT NULL,
);

CREATE TABLE posts (
   id INT AUTO_INCREMENT PRIMARY KEY,
   title VARCHAR(255),
   content TEXT,
   image VARCHAR(255) not null DEFAULT 'default.jpg',
   created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);