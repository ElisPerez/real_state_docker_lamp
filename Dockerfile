# Utiliza la imagen base de PHP con Apache
FROM php:8.0.0-apache
LABEL maintainer="Leadeer <codewithleader@gmail.com>"

# Argumento para evitar interacciones durante la instalación
ARG DEBIAN_FRONTEND=noninteractive

# Actualiza e instala las dependencias de sistema
RUN apt-get update \
    && apt-get install -y sendmail libpng-dev libzip-dev zlib1g-dev libonig-dev libjpeg-dev \
    && rm -rf /var/lib/apt/lists/*

# Instala extensiones requeridas de PHP
RUN docker-php-ext-install mysqli zip mbstring gd

# Instala Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instala Node.js y npm
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && apt-get install -y nodejs

# Instala YARN
ENV YARN_VERSION 1.22.19

RUN set -ex \
    && savedAptMark="$(apt-mark showmanual)" \
    && apt-get update && apt-get install -y ca-certificates curl wget gnupg dirmngr --no-install-recommends \
    && rm -rf /var/lib/apt/lists/* \
    && for key in \
    6A010C5166006599AA17F08146C2130DFD2497F5 \
    ; do \
    gpg --batch --keyserver hkps://keys.openpgp.org --recv-keys "$key" || \
    gpg --batch --keyserver keyserver.ubuntu.com --recv-keys "$key" ; \
    done \
    && curl -fsSLO --compressed "https://yarnpkg.com/downloads/$YARN_VERSION/yarn-v$YARN_VERSION.tar.gz" \
    && curl -fsSLO --compressed "https://yarnpkg.com/downloads/$YARN_VERSION/yarn-v$YARN_VERSION.tar.gz.asc" \
    && gpg --batch --verify yarn-v$YARN_VERSION.tar.gz.asc yarn-v$YARN_VERSION.tar.gz \
    && mkdir -p /opt \
    && tar -xzf yarn-v$YARN_VERSION.tar.gz -C /opt/ \
    && ln -s /opt/yarn-v$YARN_VERSION/bin/yarn /usr/local/bin/yarn \
    && ln -s /opt/yarn-v$YARN_VERSION/bin/yarnpkg /usr/local/bin/yarnpkg \
    && rm yarn-v$YARN_VERSION.tar.gz.asc yarn-v$YARN_VERSION.tar.gz \
    && apt-mark auto '.*' > /dev/null \
    && { [ -z "$savedAptMark" ] || apt-mark manual $savedAptMark > /dev/null; } \
    && find /usr/local -type f -executable -exec ldd '{}' ';' \
    | awk '/=>/ { so = $(NF-1); if (index(so, "/usr/local/") == 1) { next }; gsub("^/(usr/)?", "", so); print so }' \
    | sort -u \
    | xargs -r dpkg-query --search \
    | cut -d: -f1 \
    | sort -u \
    | xargs -r apt-mark manual \
    && apt-get purge -y --auto-remove -o APT::AutoRemove::RecommendsImportant=false \
    # smoke test
    && yarn --version

# Limpiar después de la instalación
RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Copia el archivo php.ini personalizado al contenedor
COPY php.ini /usr/local/etc/php/php.ini

# Activa el módulo de reescritura de Apache
RUN a2enmod rewrite

# ! Nota importante: Al crear la imagen hay que ejecutar el comando `docker container exec www composer update` para crear la carpeta vendor porque sinó no funciona la página en el navegador.