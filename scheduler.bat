rem batch file for running the laravel scheduler / place in project root directory
cd %~dp0
php artisan schedule:run 1>> NUL 2>&1