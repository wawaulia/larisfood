FROM webdevops/php-nginx:8.2-alpine
ENV WEB_DOCUMENT_ROOT=/app/public
WORKDIR /app
COPY . .
RUN composer install --no-dev --optimize-autoloader
RUN chown -R application:application /app/storage /app/bootstrap/cache

# Baris baru buat ngasilin file Vite manifest yang hilang tadi
RUN apk add --no-cache nodejs npm && npm install && npm run build

# Trik biar otomatis migrasi database pas server nyala
CMD php artisan migrate --force && docker-php-entrypoint-start