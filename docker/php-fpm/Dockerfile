FROM phpdockerio/php80-fpm:latest
WORKDIR /application


# Fix debconf warnings upon build
ARG DEBIAN_FRONTEND=noninteractive
#ENV COMPOSER_ALLOW_SUPERUSER 1



# Install selected extensions and other stuff
RUN apt-get update \
    && apt-get -y --no-install-recommends install php8.0-memcached php8.0-mysql php8.0-gd php8.0-redis php8.0-imagick &&  \
    apt-get install -yq supervisor mc vim htop procps telnet iputils-ping  \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Install FFMPeg extensions for watermark on video
RUN apt-get update \
    && apt-get install ffmpeg -y \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Install git
RUN apt-get update \
    && apt-get -y install git \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/* \

COPY ./supervisor.conf /etc/supervisor/conf.d/supervisord.conf