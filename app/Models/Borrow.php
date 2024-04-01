<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 *
 *
 * @property int $id
 * @property string $borrowed_at
 * @property string|null $returned_at
 * @property string|null $return_by
 * @property int $user_id
 * @property int $book_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Book $book
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RequestReturn> $requestReturns
 * @property-read int|null $request_returns_count
 * @property-read User $user
 * @method static \Database\Factories\BorrowFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Borrow newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Borrow newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Borrow query()
 * @method static \Illuminate\Database\Eloquent\Builder|Borrow whereBookId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Borrow whereBorrowedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Borrow whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Borrow whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Borrow whereReturnBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Borrow whereReturnedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Borrow whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Borrow whereUserId($value)
 * @mixin \Eloquent
 */
class Borrow extends Model
{
    use HasFactory;

    protected $fillable = [
        'borrowed_at',
        'returned_at',
        'return_by',
        'user_id',
        'book_id',
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

    /**
     * Get all of the requestReturns for the Borrow
     *
     * @return HasMany
     */
    public function requestReturns(): HasMany
    {
        return $this->hasMany(RequestReturn::class, 'borrow_id', 'id');
    }
}
