-- Inicia con...
   SELECT *
     FROM services
    WHERE name LIKE 'Corte%';

-- Finaliza con...
   SELECT *
     FROM services
    WHERE name LIKE '%Cabello';

-- Donde sea que lo encuentres
   SELECT *
     FROM services
    WHERE name LIKE '%de%';

-- Si la base de datos es 'utf8_bin' y los datos se almacenan en mayúsculas
   SELECT *
     FROM users
    WHERE LOWER(name) LIKE '%antoni%';

-- Si la base de datos es 'utf8_spanish_ci' y los datos se almacenan en mayúsculas no importa si la busqueda es en mayuscula o minuscula asi que no hace falta la funcion LOWER().
   SELECT *
     FROM users
    WHERE name LIKE '%antoni%';