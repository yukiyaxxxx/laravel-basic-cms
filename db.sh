
# database init

# .env読み取り
export $(cat .env | grep -v ^# |sed -e "s/[\r\n]\+//g"|xargs)
# コンテナ名を格納
container=${APP_PREFIX}_php
docker exec $container php artisan migrate --seed
