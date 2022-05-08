<?php namespace VseProsto\Telegram\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;
use October\Rain\Database\Schema\Blueprint;

class AddForeignKeysToVseprostoTelegramMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vseprosto_telegram_message', function (Blueprint $table) {
            $table->foreign(['left_chat_member'], 'vseprosto_telegram_message_ibfk_7')->references(['id'])->on('vseprosto_telegram_user');
            $table->foreign(['user_id'], 'vseprosto_telegram_message_ibfk_1')->references(['id'])->on('vseprosto_telegram_user');
            $table->foreign(['forward_from'], 'vseprosto_telegram_message_ibfk_3')->references(['id'])->on('vseprosto_telegram_user');
            $table->foreign(['reply_to_chat', 'reply_to_message'], 'vseprosto_telegram_message_ibfk_5')->references(['chat_id', 'id'])->on('vseprosto_telegram_message');
            $table->foreign(['via_bot'], 'vseprosto_telegram_message_ibfk_6')->references(['id'])->on('vseprosto_telegram_user');
            $table->foreign(['chat_id'], 'vseprosto_telegram_message_ibfk_2')->references(['id'])->on('vseprosto_telegram_chat');
            $table->foreign(['forward_from_chat'], 'vseprosto_telegram_message_ibfk_4')->references(['id'])->on('vseprosto_telegram_chat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vseprosto_telegram_message', function (Blueprint $table) {
            $table->dropForeign('vseprosto_telegram_message_ibfk_7');
            $table->dropForeign('vseprosto_telegram_message_ibfk_1');
            $table->dropForeign('vseprosto_telegram_message_ibfk_3');
            $table->dropForeign('vseprosto_telegram_message_ibfk_5');
            $table->dropForeign('vseprosto_telegram_message_ibfk_6');
            $table->dropForeign('vseprosto_telegram_message_ibfk_2');
            $table->dropForeign('vseprosto_telegram_message_ibfk_4');
        });
    }
}
