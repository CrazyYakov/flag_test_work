ARG PHP_VERSION=8.3

FROM php:${PHP_VERSION}-fpm-alpine

ARG USER_ID=1000
ARG GROUP_ID=1000

RUN apk update && apk add --no-cache \
    zip \
    libzip-dev \
    freetype \
    libjpeg-turbo \
    libpng \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    curl \
    postgresql-dev \
    $PHPIZE_DEPS \
    linux-headers

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN docker-php-ext-install pdo pdo_pgsql pgsql && \
    pecl install redis
RUN docker-php-ext-enable pdo pgsql redis

RUN addgroup -g ${GROUP_ID} www && \
    adduser -D -u ${USER_ID} -G www -s /bin/bash www;

USER ${USER_ID}:${GROUP_ID}

EXPOSE 9000

CMD php-fpm
