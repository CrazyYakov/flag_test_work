# Тестовое задание

Это тестовое задание написана для кампании "Студия Флаг".
REST-api для онлайн магазина.


### Установка
```bash
composer install
```

### Запуск
```bash
php artisan migrate --seed
php artisan serve
```

### Тест
```bash
php artisan test
```

### Маршруты

* **POST** _/api/user/registration_ - регистрация
* **POST** _/api/user/authorization_ - авторизация

* **GET** _/api/cart_ - корзина
* **POST** _/api/cart/{id}_ - Добавить товар в корзину
* **DELETE** _/api/cart/{id}_ - Удалить товар из корзины

* **GET** _/api/products_ - список товаров
* **GET** _/api/products/{id}_ - детальная информация о товаре

* **GET** _/api/payment/methods_ - список способов оплат

* **GET** _/api/orders_ - список заказов
* **GET** _/api/orders/{id}_ - детальная информация о заказе
* **GET** _/api/orders/create_ - создать заказ

