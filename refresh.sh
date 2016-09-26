#!/bin/bash

composer install --prefer-dist --optimize-autoloader -vvv
bower update -v
npm install
php artisan clear-compiled && composer dump-autoload && php artisan optimize
php artisan migrate