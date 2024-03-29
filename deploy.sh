#!/bin/sh

cd /srv/adventurelog.nz/
sudo -u finn git checkout master
sudo -u finn git stash
sudo -u finn git pull origin master
sudo -u finn composer install
sudo -u www-data php artisan migrate --addon=finnito.module.places
sudo -u www-data php artisan cache:clear
sudo -u www-data php artisan streams:cleanup
sudo -u www-data php artisan streams:compile
sudo -u www-data php artisan streams:index
sudo -u www-data php artisan httpcache:clear
sudo -u www-data php artisan httpcache:warm

find ./ -type f -exec chmod 644 {} \;
find ./ -type d -exec chmod 755 {} \;
chmod -R 777 ./storage
chmod -R 777 ./bootstrap/cache
chmod -R 777 ./public/app
