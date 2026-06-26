FROM richarvey/nginx-php-fpm:3.1.6

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN php artisan config:clear || true
RUN php artisan route:clear || true
RUN php artisan view:clear || true

RUN chown -R nginx:nginx storage bootstrap/cache

ENV SKIP_COMPOSER=1
ENV WEBROOT=/var/www/html/public