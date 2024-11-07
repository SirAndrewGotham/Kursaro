<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\BannerType::class)->nullable()->constrained()->onDelete('SET NULL');
            $table->boolean('all_langauges')->default(false);
            $table->boolean('active')->default(false);
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->text('teaser')->nullable();
            $table->string('path')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
