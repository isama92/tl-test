FROM php:8.1.7-fpm

WORKDIR /var/www/html

# update the system
RUN apt-get update \
  && apt-get autoremove -y

RUN apt-get install -y --no-install-recommends\
    ca-certificates curl git\
    libzip-dev zip zlib1g-dev unzip

RUN rm -rf /var/lib/apt/lists/*

# add local user
RUN useradd -u 1000 -m local

# copy config files
COPY ./www.conf /usr/local/etc/php-fpm.d/www.conf
RUN chmod o+r /usr/local/etc/php-fpm.d/www.conf
COPY ./team_liquid.ini /usr/local/etc/php/conf.d/team_liquid.ini
