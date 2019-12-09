FROM php:7.4-cli

RUN apt-get -qq update && apt-get -qq upgrade \
    && apt-get -qq install -y --no-install-recommends git unzip \
    && apt-get -qq clean \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
RUN composer global --quiet require hirak/prestissimo

COPY . /app
WORKDIR /app
RUN composer install --prefer-dist --quiet
