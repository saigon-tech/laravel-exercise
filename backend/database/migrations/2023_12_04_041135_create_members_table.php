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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            // columns: username, name, password, email, chatword_id, status, type
            $table->string('username', 20)->nullable(false);
            $table->string('name', 50)->nullable();
            $table->string('password', 255)->nullable(false);
            $table->string('email', 50)->nullable(false);
            $table->string('chatword_id', 50)->nullable();
            $table->integer('status')->nullable(false)->default(1);
            $table->integer('type')->nullable(false)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
