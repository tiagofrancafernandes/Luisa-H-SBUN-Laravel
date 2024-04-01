<?php

namespace App\Models;

use App\Enums\RequestBorrowStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 *
 *
 * @property int $id
 * @property int $user_id
 * @property int $book_id
 * @property RequestBorrowStatus $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Book $book
 * @property-read User $user
 * @method static \Database\Factories\RequestBorrowFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|RequestBorrow newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RequestBorrow newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RequestBorrow query()
 * @method static \Illuminate\Database\Eloquent\Builder|RequestBorrow whereBookId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestBorrow whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestBorrow whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestBorrow whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestBorrow whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestBorrow whereUserId($value)
 * @mixin \Eloquent
 */
class RequestBorrow extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'status',
    ];

    protected $casts = [
        'status' => RequestBorrowStatus::class,
    ];

    /**
     * Get the user that owns the Borrow
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the book that owns the Borrow
     *
     * @return BelongsTo
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }
}
