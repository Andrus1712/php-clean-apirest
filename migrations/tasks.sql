CREATE TABLE tasks
(
    id          INT AUTO_INCREMENT PRIMARY KEY,
    title       VARCHAR(255) NOT NULL,
    description TEXT         NOT NULL,
    status      ENUM('pending', 'in_progress', 'completed') NOT NULL DEFAULT 'pending',
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


INSERT INTO tasks (title, description, status)
VALUES ('Comprar víveres', 'Comprar leche, pan y huevos', 'pending'),
       ('Desarrollar API', 'Implementar endpoints en PHP', 'in_progress'),
       ('Revisar reportes', 'Analizar métricas del último mes', 'completed');
