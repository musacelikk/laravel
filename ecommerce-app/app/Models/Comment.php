<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    protected $fillable = [
        'comment',
        'rate',
        'product_id',
        'user_id',
        'reviewer_name',
        'reviewer_email',
        'ip',
        'status',
    ];

    public function displayName(): string
    {
        if ($this->reviewer_name) {
            return $this->reviewer_name;
        }

        return $this->user?->name ?? 'Guest';
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
