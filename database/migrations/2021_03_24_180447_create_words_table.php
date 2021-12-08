<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('words', function (Blueprint $table) {
            $table->id();
            $table->string('word_ar');
            $table->string('word_lt');
            $table->string('ar');
            $table->string('fr');
            $table->string('en');
            $table->longText('description');
            $table->string('origin');
            $table->string('region');
            $table->string('vocal');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('syn_id')->nullable()->constrained('words')->onDelete('cascade');
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
        Schema::dropIfExists('words');
    }
}
