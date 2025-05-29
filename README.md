# Payment API

Projeto onde estamos criando uma api de pagamento usando Laravel com PHP 8.4

### Instalação
```bash
  cp config/develop/docker/docker-compose.yml docker-compose.yml
  cp .env.example .env
  docker compose up -d
```
Após rodar esses comandos, importe o bkp do banco de dados e siga com os comandos:
```bash
    make app
    chown www-data:www-data -R storage/framework
    chown www-data:www-data -R storage/logs/
    composer update
    php artisan key:generate
    php artisan migrate
```
Para acessar a api usar o seguinte link:
```bash
    http://localhost:8080/api/
```

### Comandos úteis
- Iniciar e entrar no container: ```make app```
- Ver logs do Laravel: ```make tail```
- Lista comandos artisan (dentro do container): ```php artisan list```
- Rodar pint no modo analise(dentro do container): ```composer run pint```
- Rodar pint no modo correção(dentro do container): ```composer run pint:fix```
- Rodar php-stan (dentro do container): ```composer run phpstan```
- Rodar teste de unidade (dentro do container): ```composer run test:unit```
- Rodar teste de feature (dentro do container): ```composer run test:feature```
- Rodar processo de Deploy (dentro do container): ```make deploy```
