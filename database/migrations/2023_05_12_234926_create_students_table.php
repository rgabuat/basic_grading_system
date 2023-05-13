<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Students;
use App\Models\Courses;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('fname');
            $table->string('lname');
            $table->string('mname')->nullable();
            $table->string('gender');
            $table->string('dob');
            $table->string('email');
            $table->string('address');
            $table->string('phone_number');
            $table->string('parent_name');
            $table->string('parent_email');
            $table->string('parent_address');
            $table->string('parent_phone_number');
            $table->timestamps();
      
        });

        Schema::create('courses_students', function(Blueprint $table){
            $table->id();
            $table->foreignIdFor(Students::class);
            $table->foreignIdFor(Courses::class);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
