   SELECT COUNT(id),
          appointment_date AS Fecha
     FROM appointments
 GROUP BY appointment_date
 ORDER BY COUNT(id) DESC;

   SELECT SUM(price) AS 'Total Servicios'
     FROM services;

   SELECT MIN(price) AS 'Precio Menor'
     FROM services;