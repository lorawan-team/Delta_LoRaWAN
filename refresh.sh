#!/bin/bash

if [ ! $1 ];
then
    $1 = "ALL"
fi

if [ $1 = "API" ] || [ $1 = "ALL" ];
then
git pull
composer install --prefer-source --optimize-autoloader -vvv
php artisan clear-compiled && composer dump-autoload && php artisan optimize
php artisan migrate
fi

if [ $1 = "SECURE" ] || [ $1 = "ALL" ];
then
cd ../Delta_Secure
git pull
composer install --prefer-source --optimize-autoloader -vvv
bower update -v
php artisan clear-compiled && composer dump-autoload && php artisan optimize
php artisan migrate
fi

if [ $1 = "CLIENT" ] || [ $1 = "ALL" ];
then
cd ../Delta_Client
git pull
composer install --prefer-source --optimize-autoloader -vvv
php artisan clear-compiled && composer dump-autoload && php artisan optimize
php artisan migrate
fi

if [ $1 = "SERVICES" ] || [ $1 = "ALL" ];
then
cd ../Delta/vendor/lorawan-team/delta_service
git pull
composer install --prefer-source --optimize-autoloader -vvv
npm install
php artisan clear-compiled && composer dump-autoload && php artisan optimize
php artisan migrate
fi