<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('project_member', function (Blueprint $table) {
            $table->id();
            // columns: project_id, member_id, percentage
            $table->unsignedBigInteger('project_id')->nullable(false);
            $table->unsignedBigInteger('member_id')->nullable(false);
            $table->decimal('percentage', 2, 1)->nullable(false)->default(0.0);
            // foreign keys
            $table->foreign('project_id')->references('id')->on('projects');
            $table->foreign('member_id')->references('id')->on('members');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // drop foreign keys
        Schema::table('project_member', function (Blueprint $table) {
            $table->dropForeign(['project_id']);
            $table->dropForeign(['member_id']);
        });
        Schema::dropIfExists('project_member');
    }
};
