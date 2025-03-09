# Use the official PHP-FPM image as a base
FROM php:8.3-fpm

# Set the working directory inside the container
WORKDIR /var/www

# Install system dependencies for Laravel (for example, GD, PDO, and MySQL extensions)
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    git \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions (GD, PDO, PDO_MySQL)
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Copy the composer installer and install Composer globally
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy the application files into the container
COPY . .

# Install Composer dependencies (without dev dependencies and optimized autoloader)
RUN composer install --no-dev --optimize-autoloader

# Expose port 9000 for PHP-FPM (but Nginx will handle traffic on port 80)
EXPOSE 9000

# Start PHP-FPM when the container starts
CMD ["php-fpm"]
