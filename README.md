# Laravel Subscription Management Microservice

A Laravel 12-based backend microservice to manage user subscriptions, built as part of a senior developer assessment. Includes scheduled tasks, queue workers, notifications, and clean API architecture.

---

## 🚀 Features

- Laravel 12 (modular bootstrap)
- Sanctum authentication
- Enum-based roles (`ADMIN`, `USER`)
- Role-based access via Gates and Policies
- Subscription creation and auto-renewal
- Queued notifications for reminders and renewals
- Scheduled job execution
- Response formatting via custom trait
- Postman collection and seeders included

---

## ⚙️ Requirements

- PHP 8.2+
- Composer
- MySQL or SQLite
- Laravel 12
- Redis (optional) or Database queue (default used)

---

## 🧑‍💻 Installation & Setup

```bash
git clone <repo>
cd subscription-management-microservice

composer install

cp .env.example .env
php artisan key:generate

php artisan migrate --seed

🕓 How to Run the Scheduler and Queue
✅ Start the Queue Worker
To process queued jobs like sending notifications or renewing subscriptions:
php artisan queue:work
Make sure this is set in your .env file:
QUEUE_CONNECTION=database

Create the jobs table if not already done:

php artisan queue:table
php artisan migrate

✅ Run the Scheduler
To manually trigger scheduled jobs (like renewals):
php artisan schedule:run
To run automatically, add this cron job to your system:
* * * * * php /path-to-your-project/artisan schedule:run >> /dev/null 2>&1 

This ensures:

Subscriptions with auto_renew = true are renewed on time

Notification jobs like reminders are dispatched

Your background jobs run every minute, production-style
```


🧠 Assumed Logic
One active subscription per user

Admins can view all subscriptions

Users can only view their own subscriptions

auto_renew = true triggers renewals automatically via scheduled job

Notifications sent via Laravel Notification system (log/mail)

Jobs handled asynchronously through queue workers



📂 Project Structure
app/
├── Actions/
├── Http/
│   ├── Controllers/
│   ├── Requests/
│   └── Resources/
├── Jobs/
├── Models/
├── Notifications/
├── Policies/
├── Traits/
├── Providers/
└── Enums/

