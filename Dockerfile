FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    default-mysql-client

# Installer PDO MySQL-driver
RUN docker-php-ext-install pdo pdo_mysql

# Installer Composer globalt
RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

# Konfigurer Apache til Railway-porten
ARG PORT=8080
ENV PORT=${PORT}
RUN sed -i "s/80/${PORT}/g" /etc/apache2/ports.conf && \
    sed -i "s/:80/:${PORT}/g" /etc/apache2/sites-available/000-default.conf

# Sæt DocumentRoot til public
RUN sed -i "s|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g" /etc/apache2/sites-available/000-default.conf

COPY . .

RUN composer install --no-dev --optimize-autoloader

EXPOSE ${PORT}