<?php

declare(strict_types=1);

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Carbon;

use function number_format;
use function sprintf;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $sku
 * @property string $name
 * @property int $price
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read string|null $formatted_created_at
 * @property-read string $formatted_price
 * @property-read string|null $formatted_updated_at
 * @method static Builder|Product newModelQuery()
 * @method static Builder|Product newQuery()
 * @method static Builder|Product query()
 * @method static Builder|Product whereCreatedAt($value)
 * @method static Builder|Product whereId($value)
 * @method static Builder|Product whereName($value)
 * @method static Builder|Product wherePrice($value)
 * @method static Builder|Product whereSku($value)
 * @method static Builder|Product whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Product extends Model
{
    use HasFactory;

    /**
     * @var string[]
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.PropertyTypeHint.MissingNativeTypeHint
     */
    protected $fillable = [
        'sku',
        'name',
        'price',
    ];

    public function getFormattedPriceAttribute(): string
    {
        return sprintf('$ %s', number_format($this->price / 100, 2));
    }

    public function getFormattedCreatedAtAttribute(): ?string
    {
        return $this->created_at?->format('d-m-Y H:i:s');
    }

    public function getFormattedUpdatedAtAttribute(): ?string
    {
        return $this->updated_at?->format('d-m-Y H:i:s');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function slug(): MorphOne
    {
        return $this->morphOne(Category::class, 'slugable');
    }
}
