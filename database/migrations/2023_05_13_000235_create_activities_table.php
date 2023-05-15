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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('total');

            $table->unsignedBigInteger('grading_periods_id');
            $table->unsignedBigInteger('requirements_id');

            $table->unsignedBigInteger('subjects_id');
            $table->timestamps();
            $table->foreign('grading_periods_id')->references('id')->on('grading_periods')->onDelete('cascade');
            $table->foreign('subjects_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->foreign('requirements_id')->references('id')->on('requirements')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
