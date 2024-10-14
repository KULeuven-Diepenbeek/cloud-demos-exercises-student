#!/bin/sh

# DEVELOPMENT mode
echo "RUNNING in development mode"
tail -f /dev/null

# # LIVE mode
# echo "RUNNING in live mode"
# cd /app/consumeApi && php artisan serve --host 0.0.0.0





## Attach shel (RUN on host: docker exec -it laravel_consume_api /bin/bash) or attach VSCode
##### COMMANDS FOR INSIDE THE CONTAINER

## Create a new laravel project
# RUN: composer create-project laravel/laravel consumeApi

## Serve app so also available in on host
# RUN: php artisan serve --host 0.0.0.0

## Check database connection
# in .env: DB_CONNECTION=mysql
# RUN: echo "DB::connection()->getPdo();" | php artisan tinker
# RUN: php artisan migrate

## Now use it like any other app
