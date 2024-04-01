#  SBUN Laravel

### Install

```sh
composer install
```

```sh
npm install
```

```sh
npm run build
```

```sh
cp .env.example .env
```

```sh
php artisan key:generate
```

#### Setup database

On `.env` file ajust the values started with `DB_` like `DB_CONNECTION`, `DB_HOST` etc.


#### Runnnig migrations

```sh
php artisan migrate --step --seed
```

#### Up the server
```sh
php artisan serve
```
