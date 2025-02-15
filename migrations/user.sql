CREATE TABLE users
(
    id    INT AUTO_INCREMENT PRIMARY KEY,
    name  VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
);


INSERT INTO users (name, email, password)
VALUES ('Juan Pérez', 'juan.perez@example.com', '$2y$10$cK0R81V7j6VdC41IS9FtK.tA1GAAlnOiF5SECq4IVxaDMIYn6Elq.'),
       ('María González', 'maria.gonzalez@example.com', '$2y$10$cK0R81V7j6VdC41IS9FtK.tA1GAAlnOiF5SECq4IVxaDMIYn6Elq.'),
       ('Carlos Ramírez', 'carlos.ramirez@example.com', '$2y$10$cK0R81V7j6VdC41IS9FtK.tA1GAAlnOiF5SECq4IVxaDMIYn6Elq.'),
       ('Ana Torres', 'ana.torres@example.com', '$2y$10$cK0R81V7j6VdC41IS9FtK.tA1GAAlnOiF5SECq4IVxaDMIYn6Elq.'),
       ('Luis Fernández', 'luis.fernandez@example.com', '$2y$10$cK0R81V7j6VdC41IS9FtK.tA1GAAlnOiF5SECq4IVxaDMIYn6Elq.');
