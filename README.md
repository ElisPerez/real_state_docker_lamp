# docker-lamp

Docker with Apache, MySQL 8.0, PHPMyAdmin and PHP.

I use docker-compose as an orchestrator. To run these containers:

```
docker-compose up -d
```

Stop and delete containers:

```
docker-compose down
```

Delete all (Containers and Images):

```
docker compose down --volumes --rmi all
```

Open phpmyadmin at [http://127.0.0.1:8000](http://127.0.0.1:8000)
Open web browser to look at a simple php example at [http://127.0.0.1:80](http://127.0.0.1:80)

Clone YourProject on `www/` and then, open web [http://127.0.0.1/YourProject](http://127.0.0.1/YourProject)

Run MySQL client:

- `docker compose exec db mysql -u root -p`

### Infrastructure model

![Infrastructure model](.infragenie/infrastructure_model.png)

## dump directory

- En el archivo docker-compose.yml, estamos usando el volumen mapeado `./dump:/docker-entrypoint-initdb.d`, lo que significa que cualquier archivo SQL que coloquemos en el directorio local "dump" se copiará automáticamente al directorio /docker-entrypoint-initdb.d en el contenedor de MySQL cuando se inicie.
- Estos archivos SQL se ejecutarán automáticamente durante el proceso de inicio de MySQL y cargarán los datos en la base de datos.
- El nombre "dump" en este contexto se refiere al directorio local que contiene archivos SQL para inicializar la base de datos MySQL.

# Notas de PHP
- La función `mysqli_fetch_assoc` devuelve una fila de la tabla cada vez que se llame. Cuando se acaban las filas devuelve null.
