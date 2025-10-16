# Тестовое задание

Это тестовое задание написана для кампании "Студия Флаг".
REST-api для онлайн магазина.

## Дополнительно для Виктора:
Написал под архитектуру DDD, отрефакторил код.
Не все проверено, что все работает

### Установка
```bash
composer install
php artisan key:generate
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

#### Auth
* **POST** _/api/auth/registration_ - регистрация
* **POST** _/api/auth/authorization_ - авторизация

#### Cart
* **GET** _/api/cart_ - корзина
* **POST** _/api/cart/{id}_ - Добавить товар в корзину
* **DELETE** _/api/cart/{id}_ - Удалить товар из корзины
* **POST** _/api/cart/pay/{paymentMethodId}_ - оплатить корзину

#### Product
* **GET** _/api/products_ - список товаров
* **GET** _/api/products/{id}_ - детальная информация о товаре

#### Payment
* **GET** _/api/payment/methods_ - список способов оплат
* **GET** _/api/payment/generate/url/{PaymentMethodEnum}_ - сгенерировать ссылку

#### Order
* **GET** _/api/orders_ - список заказов
* **GET** _/api/orders/{id}_ - детальная информация о заказе
* **POST** _/api/orders/payed/{id}_ - оплатить заказ (куда ведет сгенерированная ссылка)
