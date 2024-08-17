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
    Schema::create('interns', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('userId'); // Foreign key referencing 'users' table
        $table->unsignedBigInteger('id_number');
        $table->integer('year_level');
        $table->string('sex');
        $table->string('address');
        $table->unsignedBigInteger('contact_number');
        $table->date('date_of_birth');
        $table->string('place_of_birth');
        $table->integer('age');
        $table->string('father');
        $table->string('father_occupation');
        $table->unsignedBigInteger('father_contact_no');
        $table->string('mother');
        $table->string('mother_occupation');
        $table->unsignedBigInteger('mother_contact_no');
        $table->string('guardian_address');
        $table->unsignedBigInteger('guardian_contact_no');
        $table->string('ojt_instructor');
        $table->unsignedBigInteger('instructor_contact_no');
        $table->timestamps();
        // Define foreign key relationship
        $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interns');
    }
};
