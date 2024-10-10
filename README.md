<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Project

Project ini merupakan admin panel dari E-Learning App, dimana Admin dapat melakukan Create, Read, Update, Delete (CRUD) pada data <i>Student</i> dan <i>Room</i>. 

## ERD Diagram

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
5. JWT for Auth

## Project Structure
Pembagian struktur folder dalam project disesuaikan dengan fungsionalitas masing-masing. Contoh untuk kebutuhan API dan Web masing-masing memiliki kebutuhan sendiri, return response API berupa JSON sedangkan return response Web berupa view.
```
├── App/
│   └── Http/
│       └── Controllers/
│           ├── Api/
│           │   ├── AuthController.php     # Auth Controller for API Route
│           │   ├── RoomController.php     # Room Controller for API Route
│           │   └── StudentController.php  # Student Controller for API Route
│           ├── Web/
│           │   ├── AuthController.php     # Auth Controller for Web Route
│           │   ├── RoomController.php     # Room Controller for Web Route
│           │   └── StudentController.php  # Student Controller for Web Route
│           ├── PageController.php         # Page Controller
│           └── Controller.php
├── Routes/
│   ├── api.php
│   └── web.php
└── Resources/
    └── views/
        ├── auth/
        │   └── login.blade.php            # Page for login
        ├── components/
        │   ├── app-layout.blade.php       # Component for base HTML
        │   └── table.blade.php            # Table component
        ├── room/
        │   ├── edit.blade.php             # Edit Page for Room 
        │   └── store.blade.php            # Store Page for Room
        └── student/
            ├── edit.blade.php             # Edit Page for Student
            └── store.blade.php            # Store Page for Student
```

## API Endpoint
### Auth
| Method | Endpoint              | Authentication    |
|--------|-----------------------|-------------------|
| POST   | `/api/auth/login`      | No                |

### Students
| Method | Endpoint              | Authentication    |
|--------|-----------------------|-------------------|
| GET    | `/api/students`        | No                |
| POST   | `/api/students`        | Yes (JWT Token)   |
| PUT    | `/api/students/{id}`   | Yes (JWT Token)   |
| DELETE | `/api/students/{id}`   | Yes (JWT Token)   |

### Rooms
| Method | Endpoint              | Authentication    |
|--------|-----------------------|-------------------|
| GET    | `/api/rooms`           | No                |
| POST   | `/api/rooms`           | Yes (JWT Token)   |
| PUT    | `/api/rooms/{id}`      | Yes (JWT Token)   |
| DELETE | `/api/rooms/{id}`      | Yes (JWT Token)   |

Full docs : [https://dbdocs.io/bagusrosfandy/dot-test?view=relationships](https://documenter.getpostman.com/view/18253625/2sAXxPBDAg)
