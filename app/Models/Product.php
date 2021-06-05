<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use function number_format;
use function sprintf;

class Product extends Model
{
    /**
     * @var string[]
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.PropertyTypeHint.MissingNativeTypeHint
     */
    protected $fillable = [
        'sku',
        'slug',
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
}
