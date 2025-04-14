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
        Schema::create('borrow', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('member_id')->constrained('members')->onDelete('cascade'); // Foreign key to members table
            $table->date('borrow_date'); // Date when the book was borrowed
            $table->date('due_date'); // Date when the book is due
            $table->date('return_date')->nullable(); // Date when the book was returned
            $table->string('status_book')->default('borrowed'); // Status of the book
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrow');
    }
};
