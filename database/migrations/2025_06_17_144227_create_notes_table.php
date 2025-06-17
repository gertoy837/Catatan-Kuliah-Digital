<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Pembuat catatan
            
            // Relasi untuk catatan pribadi
            $table->foreignId('topic_id')->nullable()->constrained()->onDelete('cascade');
            
            // Relasi untuk catatan kolaboratif
            $table->foreignId('workspace_id')->nullable()->constrained()->onDelete('cascade');

            $table->string('title');
            $table->longText('body');
            $table->string('shareable_token', 40)->unique()->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};