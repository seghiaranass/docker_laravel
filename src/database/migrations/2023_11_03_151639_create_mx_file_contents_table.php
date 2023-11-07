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
        Schema::create('mx_file_contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mx_file_id')->constrained('mx_files_infos')->onDelete('cascade');
            $table->string('email_address');
            $table->boolean('checked')->default(false);
            $table->boolean('is_valid')->nullable();
            $table->text('mx_record')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mx_file_conents');
    }
};
