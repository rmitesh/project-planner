## Project Planner

- A Mordan Project Planing tool for the Leaders.

### Requirement
PHP 8.2
Node 16.14.2
NPM 7.20.6

### Configuration

Install vendor dependency
```bash
composer install
```

Copy `env` file
```bash
cp .env.example .env
```

OR

```bash
copy .env.example .env
```

Generate Application Key
```bash
php artisan key:generate
```

Run migration
> Make sure you have created database and then hit this command

```bash
php artisan migrate
```

### Create Admin user

```bash
php artisan make:filament-user
```
