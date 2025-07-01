FROM php:8.2-apache

# Instala extensões necessárias para CodeIgniter
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libzip-dev \
    unzip \
    zip \
    git \
    && docker-php-ext-install pdo pdo_mysql mysqli intl

# Ativa o mod_rewrite do Apache
RUN a2enmod rewrite

# Copia o virtual host customizado
COPY apache/000-default.conf /etc/apache2/sites-available/000-default.conf
