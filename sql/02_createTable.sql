   CREATE TABLE IF NOT EXISTS services (
          id INT (11) NOT NULL AUTO_INCREMENT,
          name VARCHAR(60) NOT NULL,
          price DECIMAL(6, 2) NOT NULL,
          PRIMARY KEY (id)
          );

DESCRIBE services;

   CREATE TABLE IF NOT EXISTS appointments (
          id INT (11) NOT NULL AUTO_INCREMENT,
          firstname VARCHAR(60) NOT NULL,
          lastname VARCHAR(60) NOT NULL,
          appointment_hour TIME DEFAULT NULL,
          appointment_date DATE DEFAULT NULL,
          services VARCHAR(255) NOT NULL,
          PRIMARY KEY (id)
          );

   CREATE TABLE users (
          id INT (1) NOT NULL AUTO_INCREMENT,
          email VARCHAR(50) NOT NULL,
          password CHAR(60) NOT NULL,
          PRIMARY KEY (id)
          );

DESCRIBE users;

SHOW TABLES;