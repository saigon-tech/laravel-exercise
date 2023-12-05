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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            // columns: member_id, date, start, end, note, status
            $table->unsignedBigInteger('member_id')->nullable(false);
            $table->date('date')->nullable(false);
            $table->dateTime('start')->nullable();
            $table->dateTime('end')->nullable();
            // foreign keys: member_id
            $table->foreign('member_id')->references('id')->on('members');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // drop foreign keys
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropForeign(['member_id']);
        });
        Schema::dropIfExists('attendances');
    }
};
