-- Mostrar los registros del id 1 y 3 unicamente
   SELECT *
     FROM appointments
    WHERE id IN (1, 3);

-- Multiples consultas con AND
   SELECT *
     FROM appointments
    WHERE appointment_date = '2021-06-28'
      AND id IN (2, 10);