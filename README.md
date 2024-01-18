<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Laravel Library Management and Reservation System

[![Laravel Version](https://img.shields.io/badge/Laravel-%5E8.0-blue)](https://laravel.com)
[![License](https://img.shields.io/badge/license-MIT-green)](LICENSE)

## Description

This Laravel package provides a comprehensive library management and reservation system. It allows users to browse the library catalog, reserve books, and manage their borrowing history. The system is built on top of Laravel and utilizes modern web technologies for a seamless user experience.

## Features

- **User Authentication:** Secure user authentication and authorization.
- **Catalog Browsing:** Browse the library catalog with detailed book information.
- **Reservation System:** Users can reserve books and manage their reservations.
- **Borrowing History:** Keep track of users' borrowing history.
- **Admin Panel:** Admins can manage books, users, reservations, and more.

## Installation

1. Clone the repository:

    ```bash
    git clone https://github.com/CJLacap/laravel-library-management-system.git
    ```

2. Navigate to the project folder:

    ```bash
    cd library-management
    ```

3. Install dependencies:

    ```bash
    composer install
    ```

4. Copy `.env.example` to `.env` and configure your database settings.

5. Generate application key:

    ```bash
    php artisan key:generate
    ```

6. Migrate the database:

    ```bash
    php artisan migrate
    ```

7. Seed the database (optional):

    ```bash
    php artisan db:seed
    ```

8. Start the development server:

    ```bash
    php artisan serve
    ```

9. Visit [http://localhost:8000](http://localhost:8000) in your browser.

## Usage

- **User Roles:**
  - Regular users can browse the catalog, reserve books, and view their borrowing history.
  - Admins have additional privileges to manage books, users, and reservations.

- **Endpoints:**
  - `/Browse%20Books`: Browse the library catalog.
  - `/requests`: Manage book reservations.
  - `/admin`: Access the admin panel.

## Contributing

If you would like to contribute, please fork the repository and submit a pull request. Feel free to open issues for bug reports, feature requests, or general feedback.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
