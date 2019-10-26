FROM php:7.3-fpm-alpine

LABEL maintainer="denibasov@yandex.ru"

RUN apk update                          && \
    apk upgrade                         && \
    docker-php-source extract           && \
    apk add --no-cache                     \
        --virtual .build-dependencies      \
        $PHPIZE_DEPS                       \
        curl-dev                           \
        imagemagick-dev                    \
        zlib-dev                           \
        cyrus-sasl-dev                     \
        autoconf                           \
        g++                                \
        libtool                            \
        make                               \
        pcre-dev                        && \
    apk add --no-cache                     \
        supervisor                         \
        sudo                               \
        shadow                             \
        tini                               \
        git                                \
        bash                               \
        procps                             \
        curl                               \
        libintl                            \
        icu                                \
        icu-dev                            \
        libxml2-dev                        \
        libzip-dev                         \
        postgresql-dev                     \
        freetype-dev                       \
        libjpeg-turbo-dev                  \
        libmcrypt-dev                      \
        libpng-dev                         \
        gmp                                \
        gmp-dev                            \
        libmemcached-dev                   \
        imagemagick                    \
        libssh2                            \
        libssh2-dev                        \
        libxslt-dev                        \
        libmcrypt-dev                   && \
    pecl install imagick && \
    docker-php-ext-enable imagick                   && \
    docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ &&  \
    docker-php-ext-install -j"$(getconf _NPROCESSORS_ONLN)" \
        intl                                                \
        opcache                                             \
        bcmath                                              \
        xsl                                                 \
        zip                                                 \
        json                                                \
        xml                                                 \
        soap                                                \
        mbstring                                            \
        mysqli                                              \
        pdo                                                 \
        pdo_mysql                                           \
        pdo_pgsql                                           \
        gmp                                                 \
        iconv                                               \
        gd                                               && \
    echo "expose_php=0" > /usr/local/etc/php/php.ini            && \
    echo 'www-data  ALL=(ALL:ALL) NOPASSWD: ALL' > /etc/sudoers.d/www-data && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer && \
    apk del .build-dependencies                                 && \
    docker-php-source delete                                    && \
    rm -rf /tmp/* /var/cache/apk/*

ARG UID
ARG GUID

RUN usermod -u $UID www-data
RUN groupmod -g $GUID www-data

CMD ["supervisord", "-c", "/etc/supervisord.conf", "-n", "-j", "/supervisord.pid"]