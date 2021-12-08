<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemovedVocalAndSynIdFromWordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('words', function (Blueprint $table) {
            $table->dropForeign('words_syn_id_foreign');
            $table->dropColumn(['vocal', 'syn_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('words', function (Blueprint $table) {
            $table->string('vocal');
            $table->foreignId('syn_id')->nullable()->constrained('words')->onDelete('cascade');
        });
    }
}
