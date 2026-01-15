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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained();
            // Self-reference untuk fitur Grouping/Merge
            $table->foreignId('parent_id')->nullable()->constrained('reports')->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->string('evidence_image')->nullable();
            $table->boolean('is_anonymous')->default(false);
            $table->enum('status', ['pending', 'process', 'resolved', 'rejected', 'merged'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
