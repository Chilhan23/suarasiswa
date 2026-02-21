<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Aspiration extends Model
{

    protected $fillable = [
        'user_id', 
        'category_id', 
        'title', 
        'content', 
        'status', 
        'handled_by', 
        'admin_response'
    ];

    // Eager load relasi biar gak boros query
    protected $with = ['category', 'user'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke Admin yang nanganin
    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'handled_by');
    }
}