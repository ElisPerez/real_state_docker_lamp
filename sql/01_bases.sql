-- Para correr un comando primero sonbrear el comando y luego la conbinacion de teclas CTRL + E CTRL + E (2 veces control + E) (Tambien hice el ajuste en Atajos del Teclado para que "Run current query" funcione con el mismo comando para no tener que sombrear)
SHOW DATABASES;

CREATE DATABASE IF NOT EXISTS appsalon;

USE appsalon;

   CREATE TABLE IF NOT EXISTS servicios (
          id INT (11) NOT NULL AUTO_INCREMENT,
          name VARCHAR(60) NOT NULL,
          price DECIMAL(6, 2) NOT NULL,
          PRIMARY KEY (id)
          );

SHOW TABLES;

-- Estructura detallada de la tabla
DESCRIBE servicios;

-- Insertar un registro
   INSERT INTO servicios (name, price)
   VALUES ("Corte de cabello de niño", 60);

-- Insertar multiples registros
   INSERT INTO servicios (name, price)
   VALUES ("Peinado mujer", 80),
          ("Peinado hombre", 60);

   SELECT *
     FROM servicios;

-- ORDER BY ASC DESC
   SELECT name,
          price
     FROM servicios
 ORDER BY price DESC;

-- LIMIT
   SELECT *
     FROM servicios
    LIMIT 2;

-- ORDER BY and LIMIT
   SELECT *
     FROM servicios
 ORDER BY id DESC
    LIMIT 2;

-- WHERE
   SELECT *
     FROM servicios
    WHERE id = 3;

-- UPDATE
   UPDATE servicios
      SET price = 70
    WHERE id = 2;

   UPDATE servicios
      SET name = "Corte de Cabello de Niño",
          price = 140
    WHERE id = 2;

-- ! Eliminar row
   DELETE FROM servicios
    WHERE id = 1;

-- Modificar base de datos ADD, CHANGE, DROP COLUMN
    ALTER TABLE servicios ADD description VARCHAR(100) NOT NULL;

    ALTER TABLE servicios CHANGE description newname VARCHAR(11) NOT NULL;

    ALTER TABLE servicios
     DROP COLUMN newname;

-- ! Eliminar tabla
     DROP TABLE servicios;