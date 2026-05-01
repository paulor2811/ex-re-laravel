# Dockerfile
FROM php:8.2-cli

# Dependências do sistema
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    curl \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Workdir
WORKDIR /app

# Copia projeto
COPY . .

# Instala dependências PHP
RUN composer install

# Porta do artisan serve
EXPOSE 8000

# Comando padrão
CMD php artisan serve --host=0.0.0.0 --port=8000
