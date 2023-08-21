version: '3.1'
# Servicios
services:
  # Servicio para la base de datos MySQL
  db:
    image: mysql:8.0.34
    container_name: db
    ports:
      - '3306:3306' # Mapea el puerto 3306 del host al puerto 3306 del contenedor
    command: --default-authentication-plugin=mysql_native_password
    restart: always # Reinicia automáticamente el contenedor en caso de fallo
    environment:
      MYSQL_DATABASE: ${DB_NAME} # Nombre de la base de datos
      MYSQL_ROOT_PASSWORD: ${DB_PASSWORD} # Contraseña del usuario root
    volumes:
      - ./dump:/docker-entrypoint-initdb.d # Carga archivos SQL en la inicialización
      - ./conf:/etc/mysql/conf.d # Carga configuraciones personalizadas
      - ./mysql:/var/lib/mysql # Persistencia de datos de MySQL
    networks:
      - my_network # Conecta este servicio a la red personalizada my_network

  # NodeJS. Nota: en image podria ser tambien node:lts para que descargue la ultima version LTS (a la fecha de hoy 20 August 2023 la LTS es 18.17.1 pero si se elige la node:lts irá cambiando la version automaticamente a la ultima LTS disponible)
  node:
    image: node:18.17.1
    container_name: node
    volumes:
      - ./www:/var/www/html # Monta el directorio de la aplicación en el contenedor de Node.js
    working_dir: /var/www/html # Establece el directorio de trabajo en el contenedor
    networks:
      - my_network # Conecta este servicio a la red personalizada my_network

  # Composer
  composervice:
    image: composer:2.5.8
    container_name: composer
    volumes:
      - ./www:/var/www/html # Monta el directorio de la aplicación en el contenedor de Composer
    working_dir: /var/www/html # Establece el directorio de trabajo en el contenedor
    command: update # Comando que se ejecutará al iniciar el contenedor (composer update)
    networks:
      - my_network # Conecta este servicio a la red personalizada my_network

  # Servicio para el servidor web Apache
  www:
    build: .
    container_name: www
    image: realstate:1.0 # Nombre y etiqueta de la imagen personalizada
    ports:
      - '80:80' # Mapea el puerto 80 del host al puerto 80 del contenedor
    volumes:
      - ./www:/var/www/html # Monta la aplicación web en el directorio del contenedor
    networks:
      - my_network # Conecta este servicio a la red personalizada my_network

  # Servicio para phpMyAdmin
  phpmyadmin:
    image: phpmyadmin/phpmyadmin:5.2.1
    container_name: phpmyadmin
    ports:
      - 8000:80 # Mapea el puerto 8000 del host al puerto 80 del contenedor
    environment:
      MYSQL_USER: root
      MYSQL_PASSWORD: ${DB_PASSWORD}
      MYSQL_ROOT_PASSWORD: ${DB_PASSWORD}
    networks:
      - my_network # Conecta este servicio a la red personalizada my_network

# Definición de la red personalizada
networks:
  my_network:
    name: mynetwork # Nombre de la red personalizada
