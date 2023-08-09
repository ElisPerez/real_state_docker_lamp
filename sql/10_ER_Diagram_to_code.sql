   CREATE TABLE users (
          id INT (11) NOT NULL AUTO_INCREMENT,
          first_name VARCHAR(60) NOT NULL,
          last_name VARCHAR(60) NOT NULL,
          phone VARCHAR(10) NOT NULL,
          email VARCHAR(60) NOT NULL UNIQUE,
          PRIMARY KEY (id)
          );

   INSERT INTO users (first_name, last_name, phone, email)
   VALUES (
          'Javier',
          'Giraldo',
          '5551236478',
          'javi@mail.com'
          );

   CREATE TABLE appointments (
          id INT (11) NOT NULL AUTO_INCREMENT,
          appointment_date DATE NOT NULL,
          appointment_hour TIME NOT NULL,
          user_id INT (11) NOT NULL,
          PRIMARY KEY (id),
          KEY user_id (user_id),
          CONSTRAINT user_fk FOREIGN KEY (user_id) REFERENCES users (id)
          );

   INSERT INTO appointments (appointment_date, appointment_hour, user_id)
   VALUES ('2023-03-21', '10:30:00', 1);

-- PIVOTE TABLE
   CREATE TABLE appointments_services (
          id INT (11) NOT NULL AUTO_INCREMENT,
          appointment_id INT (11) NOT NULL,
          service_id INT (11) NOT NULL,
          PRIMARY KEY (id),
          KEY appointment_id (appointment_id),
          CONSTRAINT appointment_fk FOREIGN KEY (appointment_id) REFERENCES appointments (id),
          KEY service_id (service_id),
          CONSTRAINT service_fk FOREIGN KEY (service_id) REFERENCES services (id)
          );

   INSERT INTO appointments_services (appointment_id, service_id)
   VALUES (1, 4);

SHOW TABLES;