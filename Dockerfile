# ============================
# Stage 1 — Build Laravel app
# ============================
FROM php:8.2-fpm AS build

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev zip curl nodejs npm \
    && docker-php-ext-install pdo_mysql zip

# Copy everything first (important for artisan)
COPY . .

# Install Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer

# Install PHP dependencies (no dev)
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# Install frontend dependencies and build
RUN npm install && npm run build

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage

# ============================
# Stage 2 — Runtime container
# ============================
FROM php:8.2-fpm

WORKDIR /var/www/html

# Copy built app from previous stage
COPY --from=build /var/www/html /var/www/html

# Expose port
EXPOSE 8000

# Run Laravel server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
