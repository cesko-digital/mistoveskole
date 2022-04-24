# Step 1: Install dependencies
#
# https://hub.docker.com/_/composer
#
FROM composer:2 as build

WORKDIR /app/
COPY . /app/

RUN apk add --no-cache icu-dev postgresql-dev \
    && install-php-extensions intl \
    && install-php-extensions pgsql \
    && install-php-extensions pdo pdo_pgsql \
    && install-php-extensions opcache

RUN composer install --no-dev --no-interaction \
    && composer dump-autoload --optimize --no-dev \
    && composer symfony:dump-env prod


# Step 2: Deploy application
#
# https://github.com/docker-library/docs/blob/master/php/README.md#phpversion-apache
#
FROM php:8.1-apache

RUN apt-get update \
    && apt-get install -y acl libicu-dev libpq-dev g++ \
    && rm -rf /var/lib/apt/lists/*
RUN docker-php-ext-configure intl \
    && docker-php-ext-install \
        intl \
        pdo \
        pdo_pgsql \
        pgsql

# https://cloud.google.com/run/docs/quickstarts/build-and-deploy/deploy-php-service
#
RUN docker-php-ext-install -j "$(nproc)" opcache

RUN set -ex; \
  { \
    echo "; Cloud Run enforces memory & timeouts"; \
    echo "memory_limit = -1"; \
    echo "max_execution_time = 0"; \
    echo "; File upload at Cloud Run network limit"; \
    echo "upload_max_filesize = 32M"; \
    echo "post_max_size = 32M"; \
    echo "; Configure Opcache for Containers"; \
    echo "opcache.enable = On"; \
    echo "opcache.validate_timestamps = Off"; \
    echo "; Configure Opcache Memory (Application-specific)"; \
    echo "opcache.memory_consumption = 32"; \
  } > "$PHP_INI_DIR/conf.d/cloud-run.ini"

WORKDIR /var/www/html

ENV APP_ENV=prod
ENV HTTPDUSER='www-data'

EXPOSE 8080

COPY docker/apache.conf /etc/apache2/sites-available/000-default.conf
COPY --from=build /app /var/www/html/

RUN setfacl -dR -m u:"$HTTPDUSER":rwX -m u:$(whoami):rwX /var && \
    setfacl -R -m u:"$HTTPDUSER":rwX -m u:$(whoami):rwX /var && \
    echo "Listen 8080" >> /etc/apache2/ports.conf && \
    mkdir -p /var/www/html/var/log/ && \
    mkdir -p /var/www/html/var/cache/ && \
    usermod -u 1000 www-data && \
    chown -R www-data:www-data /var/www/ && \
    a2enmod rewrite

USER www-data

RUN php bin/console cache:clear --no-warmup \
    && php bin/console cache:warmup

CMD ["apache2-foreground"]
