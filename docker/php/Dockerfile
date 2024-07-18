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
    procps \
    libcurl4-openssl-dev \
    libxslt1-dev

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN mkdir -p /var/www/storage /var/www/bootstrap/cache

COPY . /var/www

RUN chown -R www-data:www-data /var/www
RUN chmod -R 775 /var/www/storage /var/www/bootstrap/cache

COPY ./docker/php/laravel-cron /etc/cron.d/laravel-cron

RUN chmod 0644 /etc/cron.d/laravel-cron

RUN mkdir -p /var/run/cron && chmod 777 /var/run/cron && touch /var/run/cron/crond.pid

RUN crontab /etc/cron.d/laravel-cron

COPY --chown=www-data:www-data . /var/www

EXPOSE 9000

CMD ["sh", "-c", "cron -f & php-fpm"]
