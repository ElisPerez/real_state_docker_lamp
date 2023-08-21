# Utiliza la imagen base de PHP con Apache
FROM php:8.0.0-apache

# Argumento para evitar interacciones durante la instalación
ARG DEBIAN_FRONTEND=noninteractive

# Actualiza e instala las dependencias de sistema
RUN apt-get update \
    && apt-get install -y sendmail libpng-dev libzip-dev zlib1g-dev libonig-dev libjpeg-dev \
    && rm -rf /var/lib/apt/lists/*

# Instala extensiones requeridas de PHP
RUN docker-php-ext-install mysqli zip mbstring gd

# Instala Composer
# RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instala Node.js y npm
# RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && apt-get install -y nodejs

# Copia el archivo php.ini personalizado al contenedor
COPY php.ini /usr/local/etc/php/php.ini

# Activa el módulo de reescritura de Apache
RUN a2enmod rewrite

# Comando para iniciar el servidor Apache
CMD ["apache2-foreground"]
