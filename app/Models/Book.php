<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use DateTimeZone;
use App\Enums\RequestBorrowStatus;
use Illuminate\Support\Collection;

#[\AllowDynamicProperties]
/**
 *
 *
 * @property int $id
 * @property string $title
 * @property int|null $quantity
 * @property string $reference
 * @property string|null $sinopsis
 * @property int|null $author_id
 * @property int|null $category_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Author|null $author
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Borrow> $borrows
 * @property-read int|null $borrows_count
 * @property-read Category|null $category
 * @property-read mixed $available
 * @property-read mixed $available_quantity
 * @method static \Database\Factories\BookFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Book newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Book newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Book query()
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereReference($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereSinopsis($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'quantity',
        'reference',
        'sinopsis',
        'author_id',
        'category_id',
    ];

    protected $appends = [
        'available',
        'availableQuantity',
    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getAvailableAttribute()
    {
        return $this->borrows()->whereNull('returned_at')->count() < $this->quantity;
    }

    public function getAvailableQuantityAttribute()
    {
        return $this->quantity - $this->borrows()->whereNull('returned_at')->count();
    }

    /**
     * Get all of the borrows for the Book
     *
     * @return HasMany
     */
    public function borrows(): HasMany
    {
        return $this->hasMany(Borrow::class, 'book_id', 'id');
    }

    public function borrowThis(
        User $user,
        DateTimeZone|string|null $borrowedAt = null,
        DateTimeZone|string|null $returnBy = null,
    ): Borrow|bool {
        if (!$this?->available) {
            return false;
        }

        $borrowedAt ??= now();
        $returnBy ??= now()->parse($borrowedAt)->addDays(15);

        return Borrow::create([
            'borrowed_at' => $borrowedAt,
            'return_by' => $returnBy,
            'returned_at' => null,
            'user_id' => $user->id,
            'book_id' => $this->id,
        ]);
    }

    public function requestBorrowThis(
        User $user,
        RequestBorrowStatus|null $status = null,
    ): RequestBorrow|bool {
        if (!$this?->available) {
            return false;
        }

        return RequestBorrow::create([
            'user_id' => $user->id,
            'book_id' => $this->id,
            'status' => $status ?? RequestBorrowStatus::PENDING,
        ]);
    }

    public static function keyValue(string $columnAsValue = 'title', string $columnAsKey = 'id'): Collection
    {
        $cacheKey = implode(':', [static::class, $columnAsKey, $columnAsValue]);

        return cache()->remember($cacheKey, 5 * 60, fn () => static::pluck($columnAsValue, $columnAsKey));
    }
}
