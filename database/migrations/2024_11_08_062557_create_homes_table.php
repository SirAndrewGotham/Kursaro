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
        Schema::create('homes', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_default')->default(false);
            $table->foreignIdFor(\App\Models\Language::class)->constrained('id')->on('languages')->cascadeOnDelete();
            $table->string('title')->nullable();
            $table->longText('content');
            $table->boolean('is_active')->default(true);
            $table->bigInteger('views')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homes');
    }
};
