echo '*************** dumping any previous autoload configs  **************'
composer dumpautoload

echo '************************ migratings all core tables ********************************'
php artisan migrate

# echo '************************ creating passport clients and keys ********************************'
# php artisan passport:install

echo '************************ seeding all tables with initial data values ********************************'
php artisan db:seed

echo '************************ taking laravel out of maintenance node ********************************'
php artisan up