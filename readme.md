

## About project


it's simple laravel app with categories and manufactures. 
with the imposition of watermarks

### Install
in Env file change APP_URL to your domain URL.

####After this run this command.
 
php artisan migrate

php artisan db:seed --class="ManufacturersTableSeeder"

php artisan db:seed --class="CategoriesTableSeeder"