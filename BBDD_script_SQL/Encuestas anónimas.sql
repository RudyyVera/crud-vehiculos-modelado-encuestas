-- Crear base de datos
CREATE DATABASE sistema_encuestas;
USE sistema_encuestas;

-- Tabla: encuestas
CREATE TABLE encuestas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    descripcion TEXT,
    fecha_creacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Tabla: preguntas
CREATE TABLE preguntas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    encuesta_id INT NOT NULL,
    texto_pregunta VARCHAR(255) NOT NULL,
    tipo_pregunta VARCHAR(50) NOT NULL,
    fecha_creacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    
    CONSTRAINT fk_preguntas_encuesta
    FOREIGN KEY (encuesta_id)
    REFERENCES encuestas(id)
    ON DELETE CASCADE
);

-- Tabla: opciones
CREATE TABLE opciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pregunta_id INT NOT NULL,
    texto_opcion VARCHAR(255) NOT NULL,

    CONSTRAINT fk_opciones_pregunta
    FOREIGN KEY (pregunta_id)
    REFERENCES preguntas(id)
    ON DELETE CASCADE
);

-- Tabla: respuestas
CREATE TABLE respuestas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    opcion_id INT NOT NULL,
    fecha_respuesta TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_respuestas_opcion
    FOREIGN KEY (opcion_id)
    REFERENCES opciones(id)
    ON DELETE CASCADE
);