# Gunakan image PHP + Apache
FROM php:8.1-apache

# Install ekstensi mysqli dan dompdf membutuhkan beberapa ekstensi lain
RUN apt-get update && apt-get install -y \
    unzip \
    libzip-dev \
    zip \
    && docker-php-ext-install mysqli

# Salin semua file ke dalam container
COPY . /var/www/html/

# Pindahkan index.php ke direktori utama Apache (jika perlu)
WORKDIR /var/www/html/

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Jalankan composer install
RUN composer install

# Buka port 80
EXPOSE 80

# Jalankan Apache
CMD ["apache2-foreground"]
