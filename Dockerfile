# Utiliza la imagen base de PHP con Apache
FROM php:8.0.0-apache
LABEL maintainer="Leadeer <codewithleader@gmail.com>"

# Argumento para evitar interacciones durante la instalación
ARG DEBIAN_FRONTEND=noninteractive

# Actualiza e instala las dependencias de sistema
RUN apt-get update \
    && apt-get install -y sendmail libpng-dev libzip-dev zlib1g-dev libonig-dev libjpeg-dev unzip nano libfreetype6-dev \
    && rm -rf /var/lib/apt/lists/*

# Instala extensiones requeridas de PHP
RUN docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg
RUN docker-php-ext-install mysqli zip mbstring gd

# Install PHP extensions (otras para mas tarde)
# RUN docker-php-ext-install pdo_mysql exif pcntl bcmath

# Instala Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Limpiar después de la instalación
RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Copia el archivo php.ini personalizado al contenedor
COPY php.ini /usr/local/etc/php/php.ini

# Activa el módulo de reescritura de Apache
RUN a2enmod rewrite

# ! Nota importante: Al crear la imagen hay que ejecutar el comando `docker container exec www composer update` para crear la carpeta vendor (si no está creada) porque sinó no funciona la página en el navegador.