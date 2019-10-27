FROM seekji/php:7.3-alpine-fpm

ARG UID
ARG GUID

RUN usermod -u $UID www-data
RUN groupmod -g $GUID www-data