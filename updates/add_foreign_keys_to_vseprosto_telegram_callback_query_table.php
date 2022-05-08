<?php namespace VseProsto\Telegram\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;
use October\Rain\Database\Schema\Blueprint;

class AddForeignKeysToVseprostoTelegramCallbackQueryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vseprosto_telegram_callback_query', function (Blueprint $table) {
            $table->foreign(['user_id'], 'vseprosto_telegram_callback_query_ibfk_1')->references(['id'])->on('vseprosto_telegram_user');
            $table->foreign(['chat_id', 'message_id'], 'vseprosto_telegram_callback_query_ibfk_2')->references(['chat_id', 'id'])->on('vseprosto_telegram_message');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vseprosto_telegram_callback_query', function (Blueprint $table) {
            $table->dropForeign('vseprosto_telegram_callback_query_ibfk_1');
            $table->dropForeign('vseprosto_telegram_callback_query_ibfk_2');
        });
    }
}
