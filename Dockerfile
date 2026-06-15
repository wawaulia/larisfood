FROM webdevops/php-nginx:8.2-alpine

# Install Node.js dan NPM buat build Vite
RUN apk add --no-cache nodejs npm

ENV WEB_DOCUMENT_ROOT=/app/public
WORKDIR /app
COPY . .

# Jalankan composer dan build aset Vite
RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build

# Atur ulang permission biar folder storage dan build bisa dibaca server
RUN chown -R application:application /app/storage /app/bootstrap/cache /app/public