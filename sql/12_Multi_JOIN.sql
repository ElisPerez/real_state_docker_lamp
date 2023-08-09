-- Unir 3 tablas
   SELECT *
     FROM appointments_services
LEFT JOIN appointments ON appointments.id = appointments_services.appointment_id
LEFT JOIN services ON services.id = appointments_services.service_id
LEFT JOIN users ON users.id = appointments.user_id;