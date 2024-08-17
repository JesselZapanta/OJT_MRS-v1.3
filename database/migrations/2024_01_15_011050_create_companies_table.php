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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userId'); // Foreign key referencing 'users' table
            $table->string('company_name');
            $table->string('company_address');
            $table->unsignedBigInteger('company_contact_number');
            $table->date('date_of_application');
            $table->string('position');
            $table->string('schedule');
            $table->date('start_date');
            $table->date('end_date');

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
        Schema::dropIfExists('companies');
    }
};
