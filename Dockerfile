FROM php:8.2-fpm

ENV USER_NAME=mmk
ENV USER_HOME=/home/mmk_developer

RUN useradd -m mmk_developer

# Install necessary packages and PHP extensions



RUN apt-get update && apt-get install -y \
    libpq-dev \
    apt-utils \
    libpng-dev \
    libzip-dev \
    zip unzip \
    libgd-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    git \
    cron \
    supervisor && \
    docker-php-ext-install pdo pdo_pgsql && \
    docker-php-ext-install bcmath && \
    docker-php-ext-install gd && \
    docker-php-ext-install zip && \
    docker-php-ext-configure tokenizer && \
    docker-php-ext-install fileinfo && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

# Install the intl extension separately
RUN apt-get update && apt-get install -y libicu-dev && \
    docker-php-ext-configure intl && \
    docker-php-ext-install intl && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

# Install ImageMagick
RUN apt-get update && \
    apt-get install -y libmagickwand-dev && \
    pecl install imagick && \
    docker-php-ext-enable imagick

# Copy configuration files
#COPY ./_docker/app/php.ini /usr/local/etc/php/conf.d/php.ini
#COPY ./_docker/app/supervisor/ /etc/supervisor/conf.d
#COPY ./_docker/app/cronlab/cronjob /etc/cron.d/my-cronjob

# Install Composer
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -sS https://getcomposer.org/installer | php -- \
    --filename=composer \
    --install-dir=/usr/local/bin
RUN service supervisor start


RUN pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini






RUN #composer dump-autoload --optimize && composer run-script post-install-cmd
# Set permissions and working directory
WORKDIR /var/www/
COPY . .
COPY composer.json composer.lock ./

RUN chown -R www-data:www-data /var/www/storage
RUN composer install
