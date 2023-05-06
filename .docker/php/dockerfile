# Imagem base
FROM php:8.2-fpm-alpine

# Instala as dependências do Composer e outras ferramentas necessárias
RUN apk update \
    && apk add --no-cache \
       curl \
       oniguruma-dev \
       libzip-dev \
       unzip \
       git

# Instala as extensões do PHP necessárias
RUN docker-php-ext-install pdo_mysql zip

# Instala as dependências do Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Define as permissões de usuário
RUN mkdir -p /var/www/project
RUN chown -R www-data:www-data /var/www/project
RUN chmod 755 /var/www/project

# Define o diretório de trabalho
WORKDIR /var/www/project

# Copia o arquivo de configuração personalizado do PHP
COPY .docker/php/php.ini /usr/local/etc/php/conf.d/

# Copia o código-fonte do projeto para a imagem
COPY . .

# Instala as dependências do projeto
RUN composer install --no-scripts --no-progress --prefer-dist --optimize-autoloader

# Define o usuário padrão do contêiner
USER www-data
