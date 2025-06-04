FROM php:8.4-apache

# Instala dependências para extensões e ferramentas
RUN apt-get update && apt-get install -y \
    libonig-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo pdo_mysql mbstring zip \
    && a2enmod rewrite

RUN apt-get install -y netcat-openbsd

RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y nodejs

# Copia as configurações do Apache (se precisar, opcional)
# COPY ./apache-config.conf /etc/apache2/sites-available/000-default.conf

# Define diretório de trabalho
WORKDIR /var/www/html

# Copia o código Laravel para dentro do container
COPY . .

COPY apache-laravel.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

COPY --from=composer:2.8.9 /usr/bin/composer /usr/bin/composer

RUN composer install --no-interaction

RUN php artisan key:generate

RUN npm install && npm run build

# Dá permissão para storage e cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expõe porta 80 (Apache)
EXPOSE 80

COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh

RUN chmod +x /usr/local/bin/docker-entrypoint.sh

ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]

CMD ["apache2-foreground"]
