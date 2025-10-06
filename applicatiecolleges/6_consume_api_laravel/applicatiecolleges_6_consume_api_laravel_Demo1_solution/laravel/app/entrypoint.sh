#!/bin/bash

# Wait for database to be ready
sleep 10s

cd /app/consumeApi
composer require guzzlehttp/guzzle
php artisan migrate --force
php artisan serve --host=0.0.0.0 --port=8000
