<?php

declare(strict_types=1);

use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str as StrFacade;

class MoveProductSlugToRelation extends Migration
{
    public function up(): void
    {
        Schema::table('products', static function (Blueprint $table): void {
            $table->dropUnique(['slug']);
        });

        Schema::table('products', static function (Blueprint $table): void {
            $table->dropColumn('slug');
        });
    }

    public function down(): void
    {
        Schema::table('products', static function (Blueprint $table): void {
            $table->string('slug')->nullable()->unique();
        });

        Product::all()->each(static function (Product $product): void {
            $slug = StrFacade::slug($product->name);
            $index = 1;
            while (Product::where('slug', $slug)->first() !== null) {
                $slug = sprintf('%s-%d', $slug, $index);
            }

            // @phpstan-ignore-next-line -- This is only for backwards compatibility.
            $product->slug = $slug;
            $product->save();
        });

        Schema::table('products', static function (Blueprint $table): void {
            $table->string('slug')->nullable(false)->change();
        });
    }
}
