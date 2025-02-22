CREATE DATABASE system_tlc;
USE system_tlc;

-- Tabla para los tipos de archivo (formatos)
CREATE TABLE formatos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo VARCHAR(50) NOT NULL UNIQUE  -- Asegura que no haya tipos repetidos (ej. "imagen" solo una vez)
);

-- Tabla para los archivos multimedia
CREATE TABLE archivos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    conflicto TEXT,
    descripcion TEXT,
    archivo VARCHAR(255) NOT NULL,  -- Ruta única del archivo
    lugar VARCHAR(255),
    fecha DATE,  -- Fecha que se ingresará manualmente
    formato_id INT,  -- Relacionado con la tabla formatos
    FOREIGN KEY (formato_id) REFERENCES formatos(id) ON DELETE CASCADE,
    
    -- Restricción para evitar archivos duplicados
    UNIQUE (archivo, nombre, conflicto, descripcion, lugar, fecha, formato_id)
);

-- Tabla para registrar las acciones realizadas sobre los archivos
CREATE TABLE acciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    archivo_id INT,  -- Relacionado con la tabla archivos
    accion ENUM('crear', 'modificar', 'eliminar') NOT NULL,  -- Solo permite estos valores
    fecha_accion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (archivo_id) REFERENCES archivos(id) ON DELETE CASCADE
);

INSERT INTO formatos (tipo) VALUES ('imagen'), ('video'), ('audio'), ('documento'), ('enlace');