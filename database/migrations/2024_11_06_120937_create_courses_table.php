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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class)->nullable()->constrained('id')->on('users')->onDelete('SET NULL');
            $table->foreignIdFor(\App\Models\Language::class)->nullable()->constrained('id')->on('languages')->onDelete('SET NULL');
            $table->foreignId('course_id')->nullable()->constrained('id')->on('courses');
            $table->boolean('is_active')->default(true);
            $table->boolean('all_languages')->default(false);
            $table->string('name');
            $table->string('slug');
            $table->string('image')->nullable();
            $table->longText('description')->nullable();
            $table->string('link')->nullable();
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
        Schema::dropIfExists('courses');
    }
};
