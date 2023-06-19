# Imagem base
FROM php:8.2-fpm-alpine

# Instala as dependências do Composer e outras ferramentas necessárias
RUN apk update \
    && apk add --no-cache \
       curl \
       oniguruma-dev \
       libzip-dev \
       unzip \
       git \
       postgresql-dev

# Instala as extensões do PHP necessárias
RUN docker-php-ext-install pdo_pgsql zip

# Instala as dependências do Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Define as permissões de usuário
RUN chown -R www-data:www-data /var/www/html
RUN chmod 755 /var/www/html

# Define o diretório de trabalho
WORKDIR /var/www/html

# Copia o arquivo de configuração personalizado do PHP
COPY .docker/php/php.ini /usr/local/etc/php/conf.d/

# Instala as dependências do projeto
COPY composer.json composer.lock ./
RUN composer install --no-scripts --no-progress --prefer-dist --optimize-autoloader

# Copia o código-fonte do projeto para a imagem
COPY . .
