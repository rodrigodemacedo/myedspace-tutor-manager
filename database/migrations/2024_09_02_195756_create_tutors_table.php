<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tutors', function (Blueprint $table) {
            $table->id();
            $table->string('avatar')->nullable(); // Tutor's avatar (can be null)
            $table->string('name', 255); // Tutor's name
            $table->string('email', 255)->unique(); // Tutor's email (must be unique)
            $table->decimal('hourly_rate', 8, 2); // Tutor's hourly rate (2 decimal places)
            $table->text('bio')->nullable(); // Tutor's biography (can be null)
            $table->json('subjects'); // Subjects taught by the tutor (stored as JSON)
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tutors');
    }
};
