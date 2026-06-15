FROM webdevops/php-nginx:8.2-alpine
ENV WEB_DOCUMENT_ROOT=/app/public
WORKDIR /app
COPY . .
RUN composer install --no-dev --optimize-autoloader
RUN chown -R application:application /app/storage /app/bootstrap/cache

# Trik biar otomatis migrasi database pas server nyala
CMD php artisan migrate --force && docker-php-entrypoint-start