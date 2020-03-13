1. add you proper setting in .env for database 
2. php artisan migrate
3. php artisan db:seed
4.unit testing (create new database and add it in . env) , i have been created unit test just for one controller 
DB_TEST_CONNECTION=mysql-test
DB_TEST_HOST=127.0.0.1
DB_TEST_PORT=3306
DB_TEST_DATABASE=laravel
DB_TEST_USERNAME=laravel
DB_TEST_PASSWORD=secret
5. php artisan serve or create vhost as you like
==========================================================
.i have been created a form for create order and using caching for list them
