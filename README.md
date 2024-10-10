<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

## DB Diagram

![DB Diagram](https://github.com/rosfandy/dot-test/raw/main/thumbnail/db_diagram.svg)

Full docs : https://dbdocs.io/bagusrosfandy/dot-test?view=relationships

## Screenshoot

### Login Page
<img src="https://github.com/rosfandy/dot-test/raw/main/thumbnail/login.png" alt="Login" width="800px">

### Dashboard Page
<img src="https://github.com/rosfandy/dot-test/raw/main/thumbnail/dashboard.png" alt="Dashboard" width="800px">

### Room Page
<img src="https://github.com/rosfandy/dot-test/raw/main/thumbnail/store_room.png" alt="Add Room" width="800px">

<img src="https://github.com/rosfandy/dot-test/raw/main/thumbnail/edit_room.png" alt="Edit Room" width="800px">

### Student Page
<img src="https://github.com/rosfandy/dot-test/raw/main/thumbnail/store_student.png" alt="Add Student" width="800px">

<img src="https://github.com/rosfandy/dot-test/raw/main/thumbnail/edit_student.png" alt="Edit Student" width="800px">

## Dependency
Dependency yang digunakan dalam project ini :
1. PHP >= 7.3
2. Laravel 8
3. jQuery
4. DaisyUi (tailwindcss)

## Project Structure
```
├── App/
│   └── Http/
│       └── Controllers/
│           ├── Api/
│           │   ├── AuthController.php     # Auth Controller for API
│           │   ├── RoomController.php     # Room Controller for API
│           │   └── StudentController.php  # Student Controller for API
│           ├── Web/
│           │   ├── AuthController.php     # Auth Controller for Web
│           │   ├── RoomController.php     # Room Controller for Web
│           │   └── StudentController.php  # Student Controller for Web
│           ├── PageController.php         # Page Controller
│           └── Controller.php
├── Routes/
│   ├── api.php
│   └── web.php
└── Resources/
    └── views/
        ├── auth/
        │   └── login.blade.php
        ├── components/
        │   ├── app-layout.blade.php
        │   └── table.blade.php
        ├── room/
        │   ├── edit.blade.php
        │   └── store.blade.php
        └── student/
            ├── edit.blade.php
            └── store.blade.php
```
