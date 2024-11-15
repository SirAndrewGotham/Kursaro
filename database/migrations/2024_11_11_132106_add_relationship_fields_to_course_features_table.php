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
        Schema::table('course_features', function (Blueprint $table) {
            $table->unsignedBigInteger('feature_id')->nullable();
            $table->foreign('feature_id', 'feature_fk_10252887')->references('id')->on('course_features');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('course_features', function (Blueprint $table) {
            //
        });
    }
};
