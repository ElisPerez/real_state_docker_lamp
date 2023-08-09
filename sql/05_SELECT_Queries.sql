USE db_appsalon;

   SELECT *
     FROM services
    WHERE price > 90;

   SELECT *
     FROM services
    WHERE price >= 80;

   SELECT *
     FROM services
    WHERE price < 80;

   SELECT *
     FROM services
    WHERE price <= 80;

   SELECT *
     FROM services
    WHERE price = 80;

   SELECT *
     FROM services
    WHERE price BETWEEN 100 AND 200;