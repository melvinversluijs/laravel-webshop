<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlugsTable extends Migration
{
    public function up(): void
    {
        Schema::create('slugs', static function (Blueprint $table): void {
            $table->id();
            $table->string('slug')->unique();
            $table->bigInteger('slugable_id');
            $table->string('slugable_type');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('slugs');
    }
}
