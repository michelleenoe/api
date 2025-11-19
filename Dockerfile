FROM php:8.2-apache
ENV PORT=8080
RUN sed -i "s/80/${PORT}/g" /etc/apache2/ports.conf && \
    sed -i "s/:80/:${PORT}/g" /etc/apache2/sites-available/000-default.conf

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl

RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html
RUN sed -i "s|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g" /etc/apache2/sites-available/000-default.conf

COPY . .

RUN composer install --no-dev --optimize-autoloader

EXPOSE 80