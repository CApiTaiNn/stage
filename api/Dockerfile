# Utiliser l'image officielle PHP avec Apache
FROM php:8.2-apache

# Installer les dépendances nécessaires
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    && docker-php-ext-install zip pdo pdo_mysql

# Activer le module mod_rewrite
RUN a2enmod rewrite

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copier le code source dans le conteneur
COPY . /var/www

# Définir le répertoire de travail
WORKDIR /var/www

# Installer les dépendances PHP avec Composer
RUN composer install

# Copier le fichier de configuration Apache
#COPY apache-config.conf /etc/apache2/sites-available/000-default.conf

# Exposer le port 80
EXPOSE 80