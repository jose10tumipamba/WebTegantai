CREATE DATABASE  system_TLC;
USE system_TLC;

-- Tabla principal: Archivos (Información general)
CREATE TABLE IF NOT EXISTS archivosTLC (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    conflicto VARCHAR(255) NOT NULL,
    descripcion TEXT NOT NULL,
    lugar VARCHAR(255) NOT NULL,
    fecha DATE NOT NULL  -- Modificado para permitir entrada manual
);

-- Tabla de Formatos (Define los tipos de archivo)
CREATE TABLE IF NOT EXISTS formatoTLC (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo VARCHAR(50) NOT NULL UNIQUE COMMENT 'Ejemplo: imagen, video, audio, documento'
);

-- Tabla de Multimedia (Relaciona archivos con su formato)
CREATE TABLE IF NOT EXISTS multimediaTLC (
    id INT AUTO_INCREMENT PRIMARY KEY,
    archivo_id INT,
    formato_id INT,
    ruta VARCHAR(255) NOT NULL,
    FOREIGN KEY (archivo_id) REFERENCES archivosTLC(id) ON DELETE CASCADE,
    FOREIGN KEY (formato_id) REFERENCES formatoTLC(id) ON DELETE CASCADE
);

-- Tabla CRUD (Registra acciones en la base de datos)
CREATE TABLE IF NOT EXISTS crudTLC (
    id INT AUTO_INCREMENT PRIMARY KEY,
    archivo_id INT,
    accion VARCHAR(50) NOT NULL COMMENT 'crear, modificar, eliminar',
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (archivo_id) REFERENCES archivosTLC(id) ON DELETE CASCADE
);

-- Inserción de valores iniciales para formatos de archivo
INSERT INTO formatoTLC (tipo) VALUES 
('imagen'),
('video'),
('audio'),
('documento'),
('link')
ON DUPLICATE KEY UPDATE tipo = tipo;
