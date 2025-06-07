CREATE DATABASE IF NOT EXISTS ecommerce_db;
USE ecommerce_db;

CREATE TABLE productos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100),
  descripcion TEXT,
  precio DECIMAL(10,2),
  imagen VARCHAR(100)
);

INSERT INTO productos (nombre, descripcion, precio, imagen) VALUES
('Taza personalizada', 'Taza de cerámica con diseño único.', 129.99, 'taza.jpg'),
('Playera bordada', 'Playera de algodón con bordado artesanal.', 249.00, 'playera.jpg'),
('Caja de regalo', 'Incluye productos artesanales locales.', 399.50, 'caja.jpg'),
('Bolsa ecológica', 'Bolsa de tela reutilizable.', 89.00, 'bolsa.jpg');
