<?php
namespace App\Enums;

enum NotificationTypeEnum: string
{
    case REMINDER = 'reminder';
    case RENEWAL = 'renewal';
}