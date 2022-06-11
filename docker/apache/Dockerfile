FROM httpd:2.4.43-alpine

WORKDIR /var/www/html
VOLUME /var/www/html

# Updates
RUN apk update; \
    apk upgrade;

# Copy configurations
COPY ./vhost.conf /usr/local/apache2/conf/vhost.conf
COPY ./apache.conf /usr/local/apache2/conf/httpd.conf

# Create logs dir
RUN mkdir /var/apache_logs
