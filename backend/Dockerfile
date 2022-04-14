FROM ubuntu:22.04
RUN apt-get update && \
    DEBIAN_FRONTEND=noninteractive apt-get install -y nginx php-fpm php-curl php-xml php-pgsql composer supervisor nano && \
    rm -rf /var/lib/apt/lists/

COPY docker/php/docker-entrypoint.sh /usr/local/bin/docker-entrypoint
COPY docker/php/docker-healthcheck.sh /usr/local/bin/docker-healthcheck
RUN chmod +x /usr/local/bin/docker-healthcheck /usr/local/bin/docker-entrypoint && \
    echo "clear_env = no" >> /etc/php/8.1/fpm/pool.d/www.conf

COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/supervisord.conf /etc/supervisor/conf.d/app.conf
COPY docker/php/conf.d/symfony.prod.ini /etc/php/8.1/fpm/conf.d/symfony.ini

COPY . /var/www/html/
WORKDIR /var/www/html

RUN set -eux; \
	mkdir -p var/cache var/log; \
	composer install --prefer-dist --no-dev --no-progress --no-scripts --no-interaction; \
	composer dump-autoload --optimize --no-dev; \
	composer symfony:dump-env prod; \
	chmod +x bin/console; \
  sync

#HEALTHCHECK --interval=10s --timeout=3s --retries=3 CMD ["docker-healthcheck"]
ENTRYPOINT ["docker-entrypoint"]
EXPOSE 8080/tcp
CMD ["supervisord", "--nodaemon"]
