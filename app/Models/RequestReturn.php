<?php

namespace App\Models;

use App\Enums\RequestReturnStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 *
 *
 * @property int $id
 * @property int $borrow_id
 * @property RequestReturnStatus $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Borrow $borrow
 * @method static \Database\Factories\RequestReturnFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|RequestReturn newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RequestReturn newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RequestReturn query()
 * @method static \Illuminate\Database\Eloquent\Builder|RequestReturn whereBorrowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestReturn whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestReturn whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestReturn whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestReturn whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class RequestReturn extends Model
{
    use HasFactory;

    protected $fillable = [
        'borrow_id',
        'status',
    ];

    protected $casts = [
        'status' => RequestReturnStatus::class,
    ];

    /**
     * Get the borrow that owns the Borrow
     *
     * @return BelongsTo
     */
    public function borrow(): BelongsTo
    {
        return $this->belongsTo(Borrow::class, 'borrow_id', 'id');
    }

    public function confirmReturnThis(): bool
    {
        /**
         * @var Borrow $borrow
         */
        $borrow = $this->borrow;

        if (!$borrow) {
            return false;
        }

        if ($borrow->returned_at || !$borrow->return_by) {
            return false;
        }

        return boolval(
            $borrow?->update([
                'returned_at' => now(),
            ])
        );
    }
}
