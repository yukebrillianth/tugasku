<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable(false);
            $table->longText('details')->nullable(false);
            $table->dateTime('deadline')->nullable(true);
            $table->dateTime('reminder')->nullable(true);
            $table->boolean('reminder_active')->nullable(false);
            $table->boolean('reminder_done')->default(false);
            $table->enum('status', ['new', 'done', 'sent', 'late']);
            $table->enum('via', ['whatsapp', 'gcr', 'langsung']);
            $table->foreignId('subject_id')
                ->constrained('subjects')
                ->onDelete('cascade');
            $table->foreignId('grade_id')
                ->constrained('grades')
                ->onDelete('cascade');
            $table->foreignId('teacher_id')
                ->constrained('teachers')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assignments');
    }
}
