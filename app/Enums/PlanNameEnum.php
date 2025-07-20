<?php
namespace App\Enums;

enum PlanNameEnum: string
{
    case BASIC = 'basic';
    case PREMIUM = 'premium';
    case ENTERPRISE = 'enterprise';
}