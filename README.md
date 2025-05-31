# Payment API

Project where we are creating a payment API using Laravel with PHP 8.4

### Instalation
```bash
  cp config/develop/docker/docker-compose.yml docker-compose.yml
  cp .env.example .env
  docker compose up -d
```
After running the commands, import the database backup and continue with the commands:
```bash
    make app
    chown www-data:www-data -R storage/framework
    chown www-data:www-data -R storage/logs/
    composer update
    php artisan key:generate
    php artisan migrate
```
To access the API use the following link:
```bash
    http://localhost:8080/api/
```
### Documentation
- Swagger: http://localhost:8080/api/documentation

### Useful commands
- Start and enter the container: ```make payment_api```
- View Laravel logs: ```make tail```
- List artisan commands (inside the container): ```php artisan list```
- Run pint in analysis mode (inside the container): ```composer run pint```
- Run pint in fix mode (inside the container): ```composer run pint:fix```
- Run php-stan (inside the container): ```composer run phpstan```
- Run unit test (inside the container): ```composer run test:unit```
- Run feature test (inside the container): ```composer run test:feature```
- Run Deploy process (inside the container): ```make deploy```
