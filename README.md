## About Laravel

1. Update .env file with mysql username , password and port

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_name
DB_USERNAME=db_uername
DB_PASSWORD=db_password
```
2. composer install
3. php artisan migrate:fresh --seed
4. php artisan serve
5. Default login email: ```admin@email.com``` default login password: ```admin123456```
