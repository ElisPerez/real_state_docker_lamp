   SELECT CONCAT (firstname, ' ', lastname) AS 'Full Name'
     FROM appointments;

-- Traer todos los usuarios que tengan el nombre...
   SELECT *
     FROM appointments
    WHERE CONCAT (firstname, ' ', lastname) LIKE '%Ana Preciado%';

-- Traer todos los usuarios que tengan el nombre... + mostrando unicamente los datos que queremos y como lo queremos
   SELECT appointment_hour AS Hora,
          appointment_date AS Fecha,
          CONCAT (firstname, ' ', lastname) AS 'Nombre Completo'
     FROM appointments
    WHERE CONCAT (firstname, ' ', lastname) LIKE '%perez%';