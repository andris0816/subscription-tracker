<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubscriptionRequest;
use App\Http\Resources\SubscriptionResource;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class SubscriptionController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $subscriptions = $user->subscriptions;

        return Inertia::render('Subscription/Index', [
            'subscriptions' => SubscriptionResource::collection($subscriptions)->resolve(),
        ]);
    }

    public function show(Subscription $subscription)
    {
        // Show the specific subscription
    }

    public function store(StoreSubscriptionRequest $request)
    {
        $data = $request->validated();

        $user = Auth::user();
        $subscription = $user->subscriptions()->create($data);

        return response()->json([
            'subscription' => new SubscriptionResource($subscription)
        ]);
    }

    public function update(StoreSubscriptionRequest $request, Subscription $subscription)
    {
        Gate::authorize('update', $subscription);

        $data = $request->validated();
        $subscription->update($data);

        return back()->with([
            'subscription' => new SubscriptionResource($subscription)
        ]);
    }

    public function destroy(Subscription $subscription)
    {
        Gate::authorize('delete', $subscription);

        $subscription->delete();

        return response()->json([
            'deletedId' => $subscription->id
        ]);
    }
}
