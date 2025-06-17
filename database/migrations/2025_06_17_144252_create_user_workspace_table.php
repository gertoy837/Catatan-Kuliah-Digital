<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_workspace', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('workspace_id')->constrained()->onDelete('cascade');
            $table->string('role')->default('member'); // Contoh: 'admin', 'member'
            
            $table->primary(['user_id', 'workspace_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_workspace');
    }
};