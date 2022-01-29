<?php

declare(strict_types=1);

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Slug
 *
 * @property int $id
 * @property string $slug
 * @property int $slugable_id
 * @property class-string $slugable_type
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Category|Product $slugable
 * @method static Builder|Slug newModelQuery()
 * @method static Builder|Slug newQuery()
 * @method static Builder|Slug query()
 * @method static Builder|Slug whereCreatedAt($value)
 * @method static Builder|Slug whereId($value)
 * @method static Builder|Slug whereSlug($value)
 * @method static Builder|Slug whereSlugableId($value)
 * @method static Builder|Slug whereSlugableType($value)
 * @method static Builder|Slug whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Slug extends Model
{
    use HasFactory;

    /**
     * @var string[]
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.PropertyTypeHint.MissingNativeTypeHint
     */
    protected $fillable = [
        'slug',
    ];

    /**
     * @return MorphTo<Model, Slug>
     */
    public function slugable(): MorphTo
    {
        return $this->morphTo();
    }
}
