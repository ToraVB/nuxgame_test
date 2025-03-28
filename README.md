### 1. build project with command
```bash
  docker-compose up --build -d
```
### 2. run migrations
```bash
  docker exec laravel_app php artisan migrate
```
### 3. go to http://localhost
