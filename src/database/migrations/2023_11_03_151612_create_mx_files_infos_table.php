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
        Schema::create('mx_files_infos', function (Blueprint $table) {
            $table->id();
            $table->string('file_name');
            $table->timestamp('upload_date')->useCurrent();
            $table->integer('line_count')->default(0);
            $table->integer('processed_count')->default(0);
            $table->enum('status', ['pending', 'processing', 'completed', 'error'])->default('pending');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Adjust depending on your users table
            $table->unique('file_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mx_files_infos');
    }
};
