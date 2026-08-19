FROM php:8.5

WORKDIR /app

COPY . ./

RUN apt-get update && \
    apt-get install -y --no-install-recommends \
        curl \
        openssl \
        libpng-dev \
        libxml2-dev \
        libonig-dev \
        libzip-dev \
        libicu-dev \
        zip \
        unzip \
        make \
        git \
        && \
    apt-get clean -y && \
    rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip intl

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY --from=node:lts /usr/local/bin/node /usr/local/bin/node
COPY --from=node:lts /usr/local/lib/node_modules /usr/local/lib/node_modules

RUN ln -s /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm && \
    ln -s /usr/local/lib/node_modules/npm/bin/npx-cli.js /usr/local/bin/npx

RUN npm ci && composer install

CMD ["composer", "run", "dev", "--host=0.0.0.0"]