CREATE TABLE users
(
    id    INT AUTO_INCREMENT PRIMARY KEY,
    name  VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE
);


INSERT INTO users (name, email)
VALUES ('Juan Pérez', 'juan.perez@example.com'),
       ('María González', 'maria.gonzalez@example.com'),
       ('Carlos Ramírez', 'carlos.ramirez@example.com'),
       ('Ana Torres', 'ana.torres@example.com'),
       ('Luis Fernández', 'luis.fernandez@example.com');
