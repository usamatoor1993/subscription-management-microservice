<?php

namespace App\Notifications;

use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SubscriptionRenewedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public Subscription $subscription) {}

    /**
     * Notification delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['mail']; // You can add 'database' or 'broadcast' later if needed
    }

    /**
     * Mail content.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Your Subscription Has Been Renewed')
            ->greeting('Hello ' . $notifiable->name)
            ->line("Your **{$this->subscription->plan_name}** subscription has been successfully renewed.")
            ->line('New end date: ' . $this->subscription->end_date->toFormattedDateString())
            ->action('Manage Your Subscription', url('/')) // Replace with your frontend URL if needed
            ->line('Thank you for staying with us!');
    }
}
