   SELECT *
     FROM appointments
    INNER JOIN users ON users.id = appointments.user_id;

   SELECT *
     FROM appointments
LEFT JOIN users ON users.id = appointments.user_id;

-- Consulta primero users y luego appointments
   SELECT *
     FROM appointments
    RIGHT JOIN users ON users.id = appointments.user_id;

   SELECT *
     FROM appointments_services
LEFT JOIN appointments ON appointments.id = appointments_services.appointment_id
LEFT JOIN services ON services.id = appointments_services.service_id;