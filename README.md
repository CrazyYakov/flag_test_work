# Тестовое задание

Это тестовое задание написана для кампании "Студия Флаг".
REST-api для онлайн магазина.

# Описание

Marketplace API

Современный REST API для торговой площадки, реализованный с применением принципов Domain-Driven Design (DDD) и Clean Architecture. Проект демонстрирует декомпозицию бизнес-логики, отказоустойчивость и работу с микросервисной архитектурой.

# 🚀 Технологический стек
- Язык: PHP 8.2
- Фреймворк: Laravel 11
- Архитектура: DDD (Layers: Application, Domain, Infrastructure)
- Базы данных: PostgreSQL
- Контейнеризация: Docker, Docker Compose
- Тестирование: PHP Unit, функциональные тесты 
- Статический анализ: PHPStan (Level 8), PHP CS Fixer

# 🏗 Архитектура

Проект строго следует принципам DDD для отделения бизнес-правил от инфраструктуры:

```
app/
├── Application/     # Сервисы приложения, Use Cases (сценарии), DTO
├── Domain/          # Сущности (Entities), Объекты значения (Value Objects), Агрегаты
├── Infrastructure/  # Реализация репозиториев, кэширования, внешние API
└── Presentation/    # Контроллеры, API Resources, Middleware
```

### Установка
```bash
cp .env.example .env
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

# 📚 Основные API Endpoints

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

---

👨‍💻 Автор

Яков Рочев — Backend Developer.

- Telegram: @YakovPR
- GitHub: @CrazyYakov
