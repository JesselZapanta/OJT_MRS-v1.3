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
        Schema::create('submitted_requirements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userId');
            $table->unsignedBigInteger('requirementId');
            $table->string('institute');
            $table->string('status')->default('pending');
            $table->string('comment')->nullable();
            $table->string('file');
            $table->timestamps();

            // Define foreign key relationship
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('requirementId')->references('id')->on('set_requirements')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submitted_requirements');
    }
};
