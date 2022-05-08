<?php namespace VseProsto\Telegram\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;
use October\Rain\Database\Schema\Blueprint;

class AddForeignKeysToVseprostoTelegramPollAnswerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vseprosto_telegram_poll_answer', function (Blueprint $table) {
            $table->foreign(['poll_id'], 'vseprosto_telegram_poll_answer_ibfk_1')->references(['id'])->on('vseprosto_telegram_poll');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vseprosto_telegram_poll_answer', function (Blueprint $table) {
            $table->dropForeign('vseprosto_telegram_poll_answer_ibfk_1');
        });
    }
}
