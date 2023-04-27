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
        Schema::create('compliances', function (Blueprint $table) {
            $table->id();
            $table->string('recipient');
            $table->string('type_of_report');
            $table->string('title');
            $table->string('company');
            $table->string('department');
            $table->string('name');
            $table->string('date_time');
            $table->string('place_of_the_event');
            $table->string('detail_of_event');
            $table->string('the_attached_file')->nullable();
            $table->string('mention_anyone');
            $table->string('feel_free');
            $table->string('problem_happen');
            $table->string('problem_has_lasted');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compliances');
    }
};
