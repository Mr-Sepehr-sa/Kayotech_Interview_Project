<p align="center"><a href="https://www.kayotech.net" target="_blank"><img src="https://www.kayotech.net/wp-content/uploads/2022/02/withLogo.png" width="200" alt="Logo"></a></p>

## About This Project

A Laravel project with vue.js that implements a simple authentication framework

## Installation

Clone the Project and run the composer install command

```bash
composer install
```

change .env-example filt to .env

Then run database migration command

```bash
php artisan migrate
```
After that seed the database by db:seed command

```bash
php artisan db:seed
```

Then run the project by artisan serve

```bash
php artisan serve
```

## Description

Three users with three different roles have been added to the system for testing

1 - Admin

    username : test@bircode.net
    
    password : 12345678#

    # This user can active or inactive oter users.

2 - MidLevelAdmin

    username : test2@bircode.net
    
    password : 12345678#

    # This User just can see users list

3 - user

    username : test3@bircode.net
    
    password : 12345678#

    # This is a simple User


