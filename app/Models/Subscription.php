<?php

namespace App\Models;

use App\Currency;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subscription extends Model
{
    use HasFactory;

    protected $table = 'subscriptions';
    protected $fillable = [
        'user_id',
        'name',
        'price',
        'currency',
        'renewal_date',
        'billing_cycle',
        'cancel_url',
    ];

    protected $casts = [
        'currency' => Currency::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
