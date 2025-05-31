FROM php:8.4-apache

# Habilita mod_rewrite
RUN a2enmod rewrite

# Define diretório de trabalho
WORKDIR /var/www/html

# Instala extensões necessárias
RUN apt-get update && apt-get install -y \
	libpng-dev \
	libonig-dev \
	libxml2-dev \
	zip \
	unzip \
	git \
	curl \
	libzip-dev \
	&& docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip xml


# Define o proprietário e permissões
RUN chown -R root:www-data /var/www && chmod -R 775 /var/www

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Ajusta o DocumentRoot para /public
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf


