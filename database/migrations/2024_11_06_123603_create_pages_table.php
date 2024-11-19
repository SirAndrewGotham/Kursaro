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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('page_id')->nullable()->unsigned()->index();
            $table->foreignIdFor(\App\Models\Language::class)->nullable()->constrained('id')->on('languages')->onDelete('SET NULL');
            $table->string('title');
            $table->string('slug')->nullable();
            $table->longText('content');
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
        Schema::dropIfExists('pages');
    }
};
