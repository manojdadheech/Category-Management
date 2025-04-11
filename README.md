# 🗂️ Laravel Category Management System

A Laravel-based admin panel for managing categories in a parent-child hierarchy. Built with Bootstrap 5 for a clean and responsive UI.

---

## 🚀 Features

- Manage categories with parent-child relationships
- Display full category paths (e.g., `Bedroom > Beds > Panel Beds`)
- CRUD operations with Bootstrap UI
- Parent dropdown excludes self and its children
- Reparent children when a category is deleted
- Admin role protected routes

## 🛠️ Setup Instructions

### 1. Clone the Repository

```bash
git clone https://github.com/manojdadheech/Category-Management.git
cd Category-Management

composer install
npm install && npm run dev

cp .env.example .env
php artisan key:generate


create a database in mysql name categary

php artisan migrate --seed
you will get CategorySeeder demo data


👤 Admin Credentials
Default admin seeded from DatabaseSeeder.php

Email: admin@gmail.com
Password: 12345678


Php artisan serve
