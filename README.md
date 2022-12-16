
# Lead Form Project

In this project, Lead forms are recorded and listed.
The role model structure is used in the project. For this reason, listing processes are only for admin users.

Added middleware that controlling browsers for lead form fill page. With this middleware, whether the browsers are desktop or not and the versions are controlled.

Only the latest versions of Desktop Chrome and Safari browsers allow the Lead Form page to be opened.

The [intl-tel-input](https://intl-tel-input.com) package is used on this Lead Form filling page. With this package, the phone numbers written are checked for accuracy. At the same time, the accuracy of the email addresses written using laravel validation is checked and the authenticity of the data is analyzed.

## Skills

**-** PHP 8

**-** Laravel 9

**-** MySql

**-** Apache


## SetUp Project

Please clone the project

```bash
  git clone https://github.com/tayfurmuazzez/lead_form_project.git
```

Go to project

```bash
  cd lead_form_project
```

Running Compesser

```bash
  composer update
```

Fixed you .env file for database

```bash
  DB_DATABASE=your_db
  DB_USERNAME=your_db_username
  DB_PASSWORD=your_db_password
```

Generate App Key (If you dont have key)
```bash
  php artisan key:generate
```

Running Migration and Seeder

```bash
  php artisan migrate or php artisan migrate:refresh
  php artisan db:seed
```

Start Projects

```bash
  php artisan serve
```
