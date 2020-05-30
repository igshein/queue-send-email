#!/bin/sh

# if [ ! -f "/etc/bebebe" ]; then echo "File exist"; fi

wget -O /wait https://github.com/ufoscout/docker-compose-wait/releases/download/2.5.0/wait
chmod +x /wait
/wait

service cron start && service rsyslog start
chmod -R o+w public
chmod -R o+w storage
chmod -R o+w bootstrap/cache
chmod -R o+w frontend
cp .env-configured .env
composer install
php artisan cache:clear
php artisan view:clear
php artisan config:clear
php artisan migrate --seed --force
php artisan key:generate
php artisan config:cache
php-fpm
