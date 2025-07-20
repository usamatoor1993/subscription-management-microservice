<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subscription extends Model
{
    protected $fillable = [
        'user_id',
        'plan_name',
        'start_date',
        'end_date',
        'is_active',
        'auto_renew',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
