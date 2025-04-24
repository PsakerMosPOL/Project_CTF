CREATE DATABASE jest_ctf;
USE jest_ctf;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE flags (
    id INT AUTO_INCREMENT PRIMARY KEY,
    flag VARCHAR(50) UNIQUE NOT NULL,
    challenge VARCHAR(100) NOT NULL
);

CREATE TABLE user_flags (
    user_id INT,
    flag_id INT,
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (user_id, flag_id),
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (flag_id) REFERENCES flags(id)
);

-- Добавление начальных данных
INSERT INTO users (username, email, password) VALUES
('admin', 'admin@jest.ru', '$2y$10$J8z6Z5zY8z6Z5zY8z6Z5z.8z6Z5zY8z6Z5zY8z6Z5zY8z6Z5zY8z'), -- Пароль: admin123
('user1', 'user1@jest.ru', '$2y$10$J8z6Z5zY8z6Z5zY8z6Z5z.8z6Z5zY8z6Z5zY8z6Z5zY8z6Z5zY8z');

INSERT INTO flags (flag, challenge) VALUES
('JEST_XSS_FLAG_2025', 'XSS Playground'),
('JEST_SQL_FLAG_2025', 'SQL Injector'),
('JEST_AUTH_FLAG_2025', 'AuthBuster'),
('JEST_FILE_FLAG_2025', 'FileHunter'),
('JEST_CSRF_FLAG_2025', 'CSRF Trap'),
('JEST_IDOR_FLAG_2025', 'IDOR Leak');