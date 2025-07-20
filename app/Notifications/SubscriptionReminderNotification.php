<?php

namespace App\Notifications;

use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SubscriptionReminderNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public Subscription $subscription) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Your Subscription is Expiring Soon')
            ->greeting('Hello ' . $notifiable->name)
            ->line("Your plan **{$this->subscription->plan_name}** will expire on **{$this->subscription->end_date}**.")
            ->line('If auto-renew is enabled, it will renew automatically.')
            ->action('Manage Subscription', url('/')) // You can mock a URL
            ->line('Thank you for using our service!');
    }
}