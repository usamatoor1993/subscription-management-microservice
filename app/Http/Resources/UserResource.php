<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Enums\UserRoleEnum;
use App\Http\Resources\Subscription\SubscriptionResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'name'         => $this->name,
            'email'        => $this->email,
            'role'         => $this->role instanceof UserRoleEnum
                              ? $this->role->value
                              : $this->role,
            'subscriptions' => SubscriptionResource::collection(
                $this->whenLoaded('subscriptions')
            ),
            'created_at'   => $this->created_at,
            'updated_at'   => $this->updated_at,
        ];
    }
}
