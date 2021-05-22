FROM php:7.3-apache

RUN docker-php-ext-install pdo pdo_mysql mysqli

CMD /usr/sbin/apache2ctl -D FOREGROUND

COPY . /var/www/html/

EXPOSE 80
