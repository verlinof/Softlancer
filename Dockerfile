FROM php:8.1.0-apache
WORKDIR /var/www/html

# Mod Write
RUN a2enmod rewrite

# Linux Library
RUN apt-get update -y && apt-get install -y \
  libicu-dev \