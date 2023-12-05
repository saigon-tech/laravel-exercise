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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            // columns: member_id, project_id, task_id, date, hours, note
            $table->unsignedBigInteger('member_id')->nullable(false);
            $table->unsignedBigInteger('project_id')->nullable(false);
            $table->unsignedBigInteger('task_id')->nullable(false);
            $table->date('date')->nullable(false);
            $table->decimal('hours', 3, 1)->nullable(false)->default(0);
            $table->string('note', 255)->nullable();
            // foreign keys: member_id, project_id, task_id
            $table->foreign('member_id')->references('id')->on('members');
            $table->foreign('project_id')->references('id')->on('projects');
            $table->foreign('task_id')->references('id')->on('tasks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // drop foreign keys
        Schema::table('activities', function (Blueprint $table) {
            $table->dropForeign(['member_id']);
            $table->dropForeign(['project_id']);
            $table->dropForeign(['task_id']);
        });
        Schema::dropIfExists('activities');
    }
};
