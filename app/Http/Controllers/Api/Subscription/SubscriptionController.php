<?php

namespace App\Http\Controllers\Api\Subscription;

use App\Http\Controllers\Controller;
use App\Http\Requests\Subscription\SubscribeRequest;
use App\Actions\Subscription\CreateSubscriptionAction;
use App\Models\Subscription;
use App\Http\Resources\SubscriptionResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Throwable;

class SubscriptionController extends Controller
{
    /**
     * Subscribe to a plan (Authenticated user).
     */
    public function subscribe(
        SubscribeRequest $request,
        CreateSubscriptionAction $action
    ) {
        try {
            $subscription = $action->handle(
                userId: Auth::id(),
                planName: $request->plan_name,
                autoRenew: $request->boolean('auto_renew', false)
            );

            return $this->successResponse(
                new SubscriptionResource($subscription),
                'Subscription created successfully.'
            );
        } catch (Throwable $e) {
            return $this->exceptionResponse($e);
        }
    }

    /**
     * Get active subscriptions for authenticated user.
     */
    public function userSubscriptions()
    {
        try {
            $subscriptions = Auth::user()
                ->subscriptions()
                ->where('is_active', true)
                ->latest()
                ->get();

            return $this->successResponse(
                SubscriptionResource::collection($subscriptions)
            );
        } catch (Throwable $e) {
            return $this->exceptionResponse($e);
        }
    }

    /**
     * Get all subscriptions (Admin-only).
     */
    public function allSubscriptions()
    {
        // dd(auth()->user()->role);
    //     dd([
    //     'user_id' => auth()->id(),
    //     'role' => auth()->user()->role,
    //     'policy_check' => auth()->user()->can('viewAny', \App\Models\Subscription::class)
    // ]);

        try {
          $this->authorize('viewAny', Subscription::class);

            $subscriptions = Subscription::with('user')
                ->latest()
                ->get();

            return $this->successResponse(
                SubscriptionResource::collection($subscriptions)
            );
        } catch (Throwable $e) {
            return $this->exceptionResponse($e);
        }
    }
}
