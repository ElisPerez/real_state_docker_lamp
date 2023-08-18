# Utiliza la imagen base de PHP con Apache
FROM php:8.0.0-apache

# Argumento para evitar interacciones durante la instalación
ARG DEBIAN_FRONTEND=noninteractive

# Instala las extensiones requeridas
RUN docker-php-ext-install mysqli

# Instala otras dependencias y extensiones
RUN apt-get update \
    && apt-get install -y sendmail libpng-dev libzip-dev zlib1g-dev libonig-dev \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install zip mbstring gd

# Instala Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Activa el módulo de reescritura de Apache
RUN a2enmod rewrite

# Copia el archivo php.ini personalizado al contenedor
COPY php.ini /usr/local/etc/php/php.ini

# Comando para iniciar el servidor Apache
CMD ["apache2-foreground"]
