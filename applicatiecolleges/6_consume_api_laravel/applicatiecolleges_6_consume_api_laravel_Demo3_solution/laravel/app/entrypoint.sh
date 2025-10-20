#!/bin/bash

# Wait for database to be ready
sleep 10s

cd /app/consumeApi
composer require guzzlehttp/guzzle
composer require fruitcake/laravel-cors
composer require --dev knuckleswtf/scribe

php artisan migrate:fresh --seed --force
php artisan serve --host=0.0.0.0 --port=8000
