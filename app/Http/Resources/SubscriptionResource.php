<?php

namespace App\Http\Resources\Subscription;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'user_id'    => $this->user_id,
            'plan_name'  => $this->plan_name,
            'start_date' => $this->start_date,
            'end_date'   => $this->end_date,
            'is_active'  => $this->is_active,
            'auto_renew' => $this->auto_renew,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
