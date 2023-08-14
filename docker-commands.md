# Comandos Básicos

- `docker pull <imagen>`
  Descarga una imagen de Docker desde un registro (como Docker Hub) a tu sistema local.

- `docker run <opciones> <imagen>`
  Crea un contenedor a partir de una imagen y lo ejecuta.

- `docker ps`
  Muestra una lista de contenedores en ejecución.

- `docker images`
  Lista las imágenes de Docker disponibles en tu sistema.

- `docker rm <contenedor>`
  Elimina uno o más contenedores.

- `docker rmi <imagen>`
  Elimina una o más imágenes.

- `docker stop <contenedor>`
  Detiene un contenedor en ejecución.

- `docker stop $(docker ps -q)`
  Detiene todos los contenedores activos. Este comando utiliza una subshell para obtener la lista de IDs de todos los contenedores en ejecución a través del comando docker ps -q y luego pasa esos IDs al comando docker stop, que detendrá cada uno de esos contenedores.

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

- `docker container ls -a`
  Lista todos los contenedores, incluyendo los detenidos.

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

- `docker compose up -d`
  Inicia contenedores definidos en un archivo docker-compose.yml en background

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
