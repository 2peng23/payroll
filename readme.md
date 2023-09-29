<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

# Attendance MS [PUP]

## Quick Start 
### Requirements
- phpv 7.4
- laravel 8
### Downloadable Requirements
- nodejs [https://nodejs.org/en/download/]
- compose [https://getcomposer.org/]
- gib [https://git-scm.com/downloads]

clone the repo
```
    git clone https://git.ebongabong.net/jobferrera/payroll-system-blmc.git
```

change current directory

```
cd attendance-system
```
install dependencies

```
composer install
````

```
npm install
````

create .env file
```
cp (unix) or copy (Windows) .env.example .env
```
generate env key
```
php artisan key:generate
```
migrate the migration and seed the database
```
php artisan migrate:fresh --seed
```
start server
```
php artisan serve
```
credentails
```
login: localhost/login
username: admin@gmail.com
password: 12345
```


