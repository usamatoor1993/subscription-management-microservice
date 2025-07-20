# Laravel 12 Subscription Management API

This is a subscription management microservice built with Laravel 12. It supports user registration, login, role-based access control, subscription creation, auto-renewals, email notifications, queue jobs, and a daily scheduler.

---

## ⚙️ Tech Stack

- Laravel 12 (API only)
- Sanctum (token-based auth)
- Queue: database driver
- Notifications via mail
- Clean action-based architecture
- Enum-based role system

---

## 🚀 Getting Started

```bash
git clone https://github.com/usamatoor1993/subscription-management-microservice
cd project-folder
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
php artisan serve
