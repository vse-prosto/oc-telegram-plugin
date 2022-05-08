<?php namespace VseProsto\Telegram\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;
use October\Rain\Database\Schema\Blueprint;

class AddForeignKeysToVseprostoTelegramChosenInlineResultTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vseprosto_telegram_chosen_inline_result', function (Blueprint $table) {
            $table->foreign(['user_id'], 'vseprosto_telegram_chosen_inline_result_ibfk_1')->references(['id'])->on('vseprosto_telegram_user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vseprosto_telegram_chosen_inline_result', function (Blueprint $table) {
            $table->dropForeign('vseprosto_telegram_chosen_inline_result_ibfk_1');
        });
    }
}
