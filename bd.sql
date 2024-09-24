CREATE DATABASE IF NOT EXISTS blog;
USE blog;

-- Tabla de perfiles
CREATE TABLE IF NOT EXISTS perfil (
    id INT AUTO_INCREMENT PRIMARY KEY,
    perfil VARCHAR(50) NOT NULL,
    lectura TINYINT(1) DEFAULT 0,
    escritura TINYINT(1) DEFAULT 0,
    administracion TINYINT(1) DEFAULT 0,
    detalles TEXT,
    permisos INT DEFAULT 0,
    estado TINYINT(1) DEFAULT 1
);

-- Tabla de usuarios
CREATE TABLE IF NOT EXISTS usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL,
    contrasenia VARCHAR(255) NOT NULL,
    nombres VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    id_perfil INT NOT NULL,
    estado TINYINT(1) DEFAULT 1,
    FOREIGN KEY (id_perfil) REFERENCES perfil(id)
);

-- Inserción de perfiles con diferentes niveles de seguridad
INSERT INTO perfil (id, perfil, lectura, escritura, administracion) 
VALUES
(1, 'Usuario Básico', 1, 0, 0),
(2, 'Moderador', 1, 1, 0),
(3, 'Administrador', 1, 1, 1);

-- Inserción de usuarios con los perfiles previamente creados
INSERT INTO usuario (usuario, contrasenia, nombres, apellidos, id_perfil, estado) 
VALUES
('usuario1', 'contraseña1', 'Juan', 'Pérez', 1, 1),
('usuario2', 'contraseña2', 'Ana', 'Gómez', 2, 1),
('usuario3', 'contraseña3', 'Luis', 'Martínez', 3, 1),
('usuario4', 'contraseña4', 'María', 'Rodríguez', 1, 1),
('usuario5', 'contraseña5', 'Pedro', 'Hernández', 2, 1),
('usuario6', 'contraseña6', 'Lucía', 'López', 3, 1),
('usuario7', 'contraseña7', 'Carlos', 'García', 1, 1),
('usuario8', 'contraseña8', 'Laura', 'Jiménez', 2, 1),
('usuario9', 'contraseña9', 'Miguel', 'Díaz', 3, 1),
('usuario10', 'contraseña10', 'Sara', 'Fernández', 1, 1);
