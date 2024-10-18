
composer require guzzlehttp/guzzle

php artisan make:model FlaskUser -m

Change files: Migration, Model, Controller

php artisan migrate



# Rest api in laravel

php artisan make:model LaravelUser -m

Change files: Migration, Model, Controller

php artisan migrate

php artisan make:factory LaravelUserFactory --model=LaravelUser
Change files: factory
php artisan make:seeder LaravelUserSeeder
Change files: seeder

php artisan db:seed --class=LaravelUserSeeder