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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            // columns: name, description, status, start, end
            $table->string('name', 50)->nullable(false);
            $table->string('description', 255)->nullable();
            $table->integer('status')->nullable(false)->default(0);
            $table->date('start')->nullable();
            $table->date('end')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
