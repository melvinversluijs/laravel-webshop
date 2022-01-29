<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\CategoryFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Carbon;

/**
 * App\Models\Category
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Product[] $products
 * @property-read int|null $products_count
 * @property-read Slug|null $slug
 * @method static CategoryFactory factory(...$parameters)
 * @method static Builder|Category newModelQuery()
 * @method static Builder|Category newQuery()
 * @method static Builder|Category query()
 * @method static Builder|Category whereCode($value)
 * @method static Builder|Category whereCreatedAt($value)
 * @method static Builder|Category whereId($value)
 * @method static Builder|Category whereName($value)
 * @method static Builder|Category whereUpdatedAt($value)
 * @mixin Eloquent
 * @property-read string|null $formatted_created_at
 * @property-read string|null $formatted_updated_at
 */
class Category extends Model
{
    use HasFactory;

    /**
     * @var string[]
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.PropertyTypeHint.MissingNativeTypeHint
     */
    protected $fillable = [
        'code',
        'name',
    ];

    public function getFormattedCreatedAtAttribute(): ?string
    {
        return $this->created_at?->format('d-m-Y H:i:s');
    }

    public function getFormattedUpdatedAtAttribute(): ?string
    {
        return $this->updated_at?->format('d-m-Y H:i:s');
    }

    /**
     * @return BelongsToMany<Product>
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    /**
     * @return MorphOne<Slug>
     */
    public function slug(): MorphOne
    {
        return $this->morphOne(Slug::class, 'slugable');
    }
}
