Laravel Bus Schedule Test Project

Описание:
Веб-приложение на Laravel для отображения расписания рейсовых автобусов с возможностью поиска и управления маршрутами. Приложение использует Docker для работы в контейнерах с Nginx, PostgreSQL и PHP 8.

Требования:
Docker и Docker Compose. Тестировалось на Docker Desktop версии 4.34.3 и выше.

Установка:
Клонирование репозитория-
bash
git clone https://github.com/YukorGit/lara.test.git
cd lara.test

Создание .env файлов:
Создайте копии .env файлов из .env.example
- для Laravel - lara.test\laravel.local\.env.example
- для Docker - lara.test\laravel.local\docker\.env.example

Запуск контейнеров:
Убедитесь, что Docker запущен, затем выполните-
bash
docker-compose up -d

Установка зависимостей:
Выполните команду установки пакетов из контейнера PHP-
bash
docker-compose exec app composer install

Запуск миграций и сидеров:
Инициализируйте базу данных-
bash
php artisan migrate
Запуск сидеров-
bash
php artisan db:seed --class=TestDataSeeder

Тестирование API:
Примеры запросов можно отправлять с помощью Postman или другого REST-клиента.

Поиск маршрута- 
URL: GET api/find-bus?from=6&to=8

Создание маршрута-
URL: POST /api/create-route
Пример тела запроса:
json

{
    "bus_number": "42",
    "stops": [8, 9, 10, 11, 12, 13, 14],
    "frequency": 15,
    "start_time": "08:00",
    "end_time": "22:00",
    "reverse_stops_to_start": true
}
Описание полей:
bus_number: Номер автобуса.
stops: Массив идентификаторов остановок.
frequency: Частота отправления в минутах.
start_time и end_time: Время начала и окончания работы маршрута.
reverse_stops_to_start: Логический параметр для использования зеркального порядка остановок в обратном направлении или обработки полученного массива остновок.

Обновление маршрута-
URL: POST /api/update-route
Пример тела запроса:
json

{
    "bus_number": "42",
    "stops": [9, 10, 11, 12, 13],
    "reverse_stops_to_start": false
    "stops_to_start": [14, 13, 12, 11, 10, 9, 8]
}

Удаление маршрута-
URL: POST /api/delete-route
Пример тела запроса:
json

{
    "bus_number": "42"
}

Дополнительные замечания
Настройки Nginx, PostgreSQL и PHP указаны в docker-compose.yml и .env.example
Все миграции и сидеры находятся в database/migrations и database/seeders и могут быть перезапущены при необходимости.
