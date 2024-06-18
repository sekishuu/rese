FROM php:7.4-fpm

WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    libonig-dev \ 
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libxml2-dev \
    cron \
    procps

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . /var/www

COPY ./docker/php/laravel-cron /etc/cron.d/laravel-cron

RUN mkdir -p /var/run/cron && chmod 777 /var/run/cron && touch /var/run/cron/crond.pid

RUN chmod 0644 /etc/cron.d/laravel-cron

RUN crontab /etc/cron.d/laravel-cron

USER root

COPY --chown=www-data:www-data . /var/www

EXPOSE 9000

CMD ["sh", "-c", "cron -f & php-fpm"]
