# Orders Server

# Описание

Marketplace API

Современный REST API для торговой площадки, реализованный с применением принципов Domain-Driven Design (DDD) и Clean Architecture. Проект демонстрирует декомпозицию бизнес-логики, отказоустойчивость и работу с микросервисной архитектурой.

# 🚀 Технологический стек
- Язык: PHP 8.2.
- Фреймворк: Laravel 11.
- Архитектура: DDD (Layers: Application, Domain, Infrastructure).
- Базы данных: PostgreSQL, Redis.
- Контейнеризация: Docker, Docker Compose.
- Тестирование: PHP Unit, функциональные тесты.
- Статический анализ: PHPStan (Level 8), PHP CS Fixer.
- Мониторинг базы данных Grafana.
- Поисковик Meilisearch 1+.

# 🏗 Архитектура

Проект строго следует принципам DDD для отделения бизнес-правил от инфраструктуры:

```
app/
├── Core
|   ├── Application/     # Сервисы приложения, Use Cases (сценарии), DTO
|   └── Domain/          # Сущности (Entities), Объекты значения (Value Objects), Агрегаты
├── Infrastructure/  # Реализация репозиториев, кэширования, внешние API
└── Presentation/    # Контроллеры, API Resources, Middleware
```

### Установка
```bash
cp .env.example .env
docker compose up -d
docker compose exec app composer i
docker compose exec app php artisan key:generate
```

### Запуск
```bash
docker compose exec app php artisan migrate --seed
```

### Тест
```bash
docker compose exec app php artisan test
```

# 📚 Основные API Endpoints

API Маршруты генерируются с помощью библиотеки l5-swagger.
Для просмотра маршрутов можете посмотреть здесь: http://localhost:8000/api/documentation 

---

👨‍💻 Автор

Яков Рочев — Backend Developer.

- Telegram: @YakovPR
- GitHub: @CrazyYakov
