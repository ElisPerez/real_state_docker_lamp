# Comandos Básicos

- `docker pull <imagen>`
  Descarga una imagen de Docker desde un registro (como Docker Hub) a tu sistema local.

- `docker run <opciones> <imagen>`
  Crea un contenedor a partir de una imagen y lo ejecuta.

- `docker ps`
  Muestra una lista de contenedores en ejecución.

  - Parámetros:
    - `-a`: Muestra todos los contenedores tanto activos como detenidos.
    - `-q`: Muestra solo los IDs de los contenedores en vez de toda la información detallada.

- `docker images`
  Lista las imágenes de Docker disponibles en tu sistema.

- `docker rm <contenedor>`
  Elimina uno o más contenedores.

- `docker rmi <imagen>`
  Elimina una o más imágenes.

- `docker stop <contenedor>`
  Detiene un contenedor en ejecución.

- `docker stop $(docker ps -q)`
  Detiene todos los contenedores activos. Este comando utiliza una subshell para obtener la lista de IDs de todos los contenedores en ejecución a través del comando docker ps -q y luego pasa esos IDs al comando docker stop, que detendrá cada uno de esos contenedores. la opción -q es un atajo para indicarle a Docker que solo queremos que se muestren los IDs de los contenedores en lugar de toda la información detallada.

- `docker start <contenedor>`
  Inicia un contenedor detenido.

- `docker restart <contenedor>`
  Reinicia un contenedor en ejecución.

- `docker logs <contenedor>`
  Muestra los registros de salida de un contenedor.

- `docker exec <opciones> <contenedor> <comando>`
  Ejecuta un comando dentro de un contenedor en ejecución.

- `docker build <opciones> <ruta>`
  Construye una imagen de Docker a partir de un archivo Dockerfile y un contexto.

# Administración de Imágenes

- `docker image pull <imagen>`
  Descarga una imagen desde un registro.

- `docker image ls`
  Lista imágenes en tu sistema.

- `docker image rm <imagen>`
  Elimina una o más imágenes.

- `docker image prune`
  Elimina imágenes no utilizadas.

# Administración de Contenedores

- `docker container ls`
  Lista contenedores en ejecución.

  - Parámetros:
    - `-a`: incluye los detenidos.

## Mostrar containers inactivos:

- `docker ps -a -f "status=exited"`: --filter se abrevia con solo -f

- `docker container rm <contenedor>`
  Elimina uno o más contenedores.

- `docker container prune`
  Elimina contenedores detenidos.

- `docker container inspect <contenedor>`
  Muestra información detallada sobre un contenedor.

- `docker container logs <contenedor>`
  Muestra los registros de un contenedor.

- `docker container exec <opciones> <contenedor> <comando>`
  Ejecuta un comando dentro de un contenedor en ejecución.

  - Ejemplo: `docker container exec -it b8b70da89ea1 /bin/bash`

    - El comando `docker container exec` te permite ejecutar comandos dentro del contenedor, y en este caso, estás ejecutando una instancia interactiva del intérprete de comandos Bash dentro del contenedor especificado.
    - Contenedor Docker: Cuando se crea un contenedor, puede tener su propio sistema de archivos independiente. En este sistema de archivos del contenedor, las ubicaciones de los archivos y directorios son específicas para ese contenedor y no están relacionadas con el sistema de archivos del host.
    - Ubicación del Intérprete de Comandos en el Contenedor: La ruta `/bin/bash` se refiere al intérprete de comandos Bash ubicado dentro del sistema de archivos del contenedor. En los sistemas Unix-like, el directorio /bin es donde se almacenan los archivos ejecutables esenciales del sistema.
    - Ejecución del Comando: Al ejecutar el comando `docker container exec -it b8b70da89ea1 /bin/bash`, estás indicando a Docker que quieras ejecutar una instancia del intérprete de comandos Bash dentro del contenedor con ID b8b70da89ea1.
    - El comando `docker container exec -it b8b70da89ea1 /bin/bash` se utiliza para ejecutar un shell interactivo dentro de un contenedor Docker específico. Veamos el significado de las opciones -it:

      - La opción `-i` (abreviatura de "interactive") indica que quieres tener una sesión interactiva con el contenedor. Esto significa que podrás enviar comandos al shell del contenedor y recibir respuestas en tiempo real.

      - La opción `-t` (abreviatura de "tty") se utiliza para asignar un pseudo terminal (TTY) en la sesión interactiva. Esto permite que los comandos que ingreses y las respuestas del contenedor se muestren de manera adecuada, como si estuvieras interactuando con un terminal normal.

      - Al usar ambas opciones `-i` y `-t`, puedes acceder a una sesión de terminal dentro del contenedor de manera interactiva. En este caso, el comando ejecuta /bin/bash, que es el intérprete de comandos Bash, dentro del contenedor con ID b8b70da89ea1. Esto te proporciona un shell dentro del contenedor para ejecutar comandos y explorar su entorno.

# Redes en Docker

- `docker network ls`
  Lista las redes de Docker en tu sistema.

- `docker network create <nombre>`
  Crea una nueva red de Docker.

- `docker network connect <red> <contenedor>`
  Conecta un contenedor a una red.

- `docker network disconnect <red> <contenedor>`
  Desconecta un contenedor de una red.

# Volúmenes en Docker

- `docker volume ls`
  Lista los volúmenes de Docker en tu sistema.

- `docker volume create <nombre>`
  Crea un nuevo volumen de Docker.

- `docker volume inspect <volumen>`
  Muestra información detallada sobre un volumen.

# Docker Compose

- `docker compose up`
  Inicia contenedores definidos en un archivo docker-compose.yml.

  - Parámetros:
    - `-d`: Se utiliza para indicar que deseas ejecutar los contenedores en segundo plano, lo que en inglés se llama "detached mode".

- `docker compose down`
  Detiene y elimina contenedores definidos en un archivo docker-compose.yml.

- `docker compose down --volumes --rmi all`
  Detendrá todos los contenedores definidos en el archivo docker-compose.yml.
  Eliminará los contenedores detenidos.
  Eliminará las redes definidas en el archivo docker-compose.yml.
  Eliminará los volúmenes definidos en el archivo docker-compose.yml.
  Eliminará todas las imágenes que fueron creadas por el archivo docker-compose.yml.

- `docker compose logs`
  Muestra los registros de contenedores definidos en un archivo docker-compose.yml.

# Comandos de Inspección y Gestión

- `docker info`
  Muestra información sobre la instalación de Docker.

- `docker version`
  Muestra la versión de Docker que está instalada.

- `docker inspect <objeto>`
  Muestra información detallada sobre un objeto Docker (imagen, contenedor, volumen, red, etc.)
