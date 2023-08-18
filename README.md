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

# Composer
- Para ejecutar comandos de Composer (composer init por ejemplo) hay que primero entrar en el contenedor WWW en docker a travez de el siguiente comando:
  - Abrir la terminal integrada de VSCode para que inicie en la carpeta del proyecto.
  - Ejecutar el comando `docker container exec -it <id-del-contenedor> /bin/bash` para entrar en la terminal bash del container.
  - Ahora si puedes escribir tus comandos de composer. Para crear tu composer.json ejecuta el comando `composer init` y sigue los pasos (es como crear el package.json de npm init).
  - Para salir de la terminal bash del contenedor escribir: `exit`.

## Composer commands

- composer init: Inicia la creacion del composer.json (tipo package.json de npm init).
- composer update: Despues de que realicemos un cambio al composer.json debemos actualizar con este comando.
- La carpeta `vendor` es el equivalente a la carpeta `node_modules` en NPM.