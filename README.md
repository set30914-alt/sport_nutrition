Sport Nutrition

Повний опис, інструкція встановлення та структура Laravel-проєкту "Sport Nutrition".

## Опис проекту

Sport Nutrition — простий інтернет-магазин на Laravel для продажу спортивного харчування. Містить:
- керування категоріями і продуктами;
- сторінки для покупців (перегляд товарів, корзина);
- панель адміністратора для CRUD операцій з товарами і категоріями;
- базу даних з сидерами для початкових даних.

Проєкт підготовлений для запуску локально (рекомендовано — Laragon на Windows) або деплою на VPS.

## Швидкий огляд (Quick start)

1. Клонувати репозиторій (якщо ще не клоновано):

   ```powershell
   git clone https://github.com/set30914-alt/sport_nutrition.git
   cd sport_nutrition
   ```

2. Встановити PHP залежності (composer):

   ```powershell
   composer install
   ```

3. Встановити JS залежності і збудувати ресурси:

   ```powershell
   npm install
   npm run dev   # або npm run build для production
   ```

4. Створити копію `.env` і налаштувати її:

   ```powershell
   copy .env.example .env
   # Відредагуйте .env: DB_DATABASE, DB_USERNAME, DB_PASSWORD, APP_URL тощо
   ```

5. Згенерувати ключ додатку та виконати міграції/сидери:

   ```powershell
   php artisan key:generate
   php artisan migrate --seed
   ```

6. Запустити локальний сервер (якщо не використовуєте Laragon):

   ```powershell
   php artisan serve --host=127.0.0.1 --port=8000
   # Відкрийте http://127.0.0.1:8000
   ```

7. Якщо ви використовуєте Laragon — помістіть проєкт у папку `www`, і Laragon автоматично надасть локальний хост (наприклад http://sport-nutrition.test) після запуску.

## Повна інструкція встановлення (Windows, PowerShell, Laragon)

Передумови:
- PHP 8.x (перевірте сумісність з `composer.json`)
- Composer
- Node.js + npm
- MySQL або MariaDB
- Git
- Рекомендовано: Laragon (зручна локальна середа для Windows)

Кроки:

1) Встановіть Laragon (або іншу локальну LAMP/LEMP збірку). Налаштуйте Apache/Nginx та MySQL.

2) Клонуйте репозиторій або скопіюйте файли у ваш робочий каталог Laragon (`C:/laragon/www/`):

   ```powershell
   git clone https://github.com/set30914-alt/sport_nutrition.git
   cd sport_nutrition
   ```

3) Встановіть PHP-залежності:

   ```powershell
   composer install --no-interaction --prefer-dist
   ```

4) Налаштуйте `.env`:

   - Скопіюйте `.env.example` в `.env`.
   - Вкажіть `DB_CONNECTION=mysql`, `DB_HOST=127.0.0.1`, `DB_PORT=3306`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`.
   - Встановіть `APP_URL` (наприклад http://localhost або http://sport-nutrition.test для Laragon).

5) Згенеруйте ключ і підготуйте базу даних:

   ```powershell
   php artisan key:generate
   php artisan migrate --seed
   ```

6) Встановіть Node залежності та збудуйте front-end:

   ```powershell
   npm install
   npm run dev     # для локальної розробки
   npm run build   # production
   ```

7) (Опціонально) Створіть символічне посилання для storage:

   ```powershell
   php artisan storage:link
   ```

8) Запустіть сервер:

   - Через Laragon — увімкніть Apache/Nginx і відкрийте локальний домен.
   - Через Artisan:

     ```powershell
     php artisan serve
     ```

## Структура проекту

Нижче наведено скорочену структуру директорій (ключові файли):

```
artisan
app/
  Http/
    Controllers/
    Middleware/
  Models/
bootstrap/
config/
database/
  migrations/
  seeders/
public/
resources/
  css/
  js/
  views/
routes/
storage/
tests/
vendor/
README.md
```

Докладніша структура:
- `app/Models` — моделі Eloquent (Product, Category, User)
- `app/Http/Controllers` — контролери для фронтенду та адміністратора
- `resources/views` — Blade шаблони
- `database/migrations` та `database/seeders` — міграції і сидери

## Налаштування Git та GitHub

- Рекомендується додати `/.env` в `.gitignore` (вже додано в проєкті).
- Перед пушем переконайтесь, що не додаєте секрети й великі бінарні файли.

Як пушити на GitHub (приклад):

```powershell
git add .
git commit -m "Your message"
git push origin main
```

Якщо віддалений репозиторій вже містить коміти, перед пушем зробіть:

```powershell
git pull --rebase origin main
git push origin main
```

## Часта перевірка і відлагодження

- Перевірити лог помилок Laravel: `storage/logs/laravel.log`
- Очистити кеши:

  ```powershell
  php artisan config:cache
  php artisan route:cache
  php artisan view:clear
  ```

- Перевірити file permissions (на Windows зазвичай неактуально, на Linux переконайтесь, що `storage` і `bootstrap/cache` доступні для запису).

## Seed дані

Проєкт містить сидери: запустіть `php artisan migrate --seed` щоб заповнити прикладними товарними вкладеннями.

## CI / Deployment (коротко)

- Можна додати GitHub Actions для автоматичного запуску тестів та build-скриптів.
- Для production запропоновано виконати `composer install --no-dev`, `npm run build`, налаштувати `.env` для production та міграції.

## Контакти та внесок

Якщо хочете внести вклад — відкрийте pull request або issue в репозиторії: https://github.com/set30914-alt/sport_nutrition

## Ліцензія

MIT (за замовчуванням) — оновіть LICENSE якщо потрібно.

---

Автор: set30914-alt
Дата оновлення README: 2025-12-18
