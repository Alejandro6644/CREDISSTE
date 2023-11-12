echo '************* putting laravel into maintenance mode ****************'
php artisan down

echo '************* migratings all core tables ***************************'
php artisan migrate:reset

