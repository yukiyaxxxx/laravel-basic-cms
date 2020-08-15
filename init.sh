docker-compose up -d
docker exec laravel_php cp .env.example .env
docker exec laravel_php composer install
docker exec laravel_php php artisan key:generate
