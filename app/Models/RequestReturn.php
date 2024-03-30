<?php

namespace App\Models;

use App\Enums\RequestReturnStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RequestReturn extends Model
{
    use HasFactory;

    protected $fillable = [
        'borrow_id',
        'status',
    ];

    protected $casts = [
        'status'=> RequestReturnStatus::class,
    ];

    /**
     * Get the borrow that owns the Borrow
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function borrow(): BelongsTo
    {
        return $this->belongsTo(Borrow::class, 'borrow_id', 'id');
    }
}
