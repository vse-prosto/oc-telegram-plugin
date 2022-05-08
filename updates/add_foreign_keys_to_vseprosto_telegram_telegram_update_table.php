<?php namespace VseProsto\Telegram\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;
use October\Rain\Database\Schema\Blueprint;

class AddForeignKeysToVseprostoTelegramTelegramUpdateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vseprosto_telegram_telegram_update', function (Blueprint $table) {
            $table->foreign(['callback_query_id'], 'vseprosto_telegram_telegram_update_ibfk_7')->references(['id'])->on('vseprosto_telegram_callback_query');
            $table->foreign(['chat_member_updated_id'], 'vseprosto_telegram_telegram_update_ibfk_13')->references(['id'])->on('vseprosto_telegram_chat_member_updated');
            $table->foreign(['pre_checkout_query_id'], 'vseprosto_telegram_telegram_update_ibfk_9')->references(['id'])->on('vseprosto_telegram_pre_checkout_query');
            $table->foreign(['chat_id', 'channel_post_id'], 'vseprosto_telegram_telegram_update_ibfk_3')->references(['chat_id', 'id'])->on('vseprosto_telegram_message');
            $table->foreign(['chat_id', 'message_id'], 'vseprosto_telegram_telegram_update_ibfk_1')->references(['chat_id', 'id'])->on('vseprosto_telegram_message');
            $table->foreign(['edited_channel_post_id'], 'vseprosto_telegram_telegram_update_ibfk_4')->references(['id'])->on('vseprosto_telegram_edited_message');
            $table->foreign(['poll_id'], 'vseprosto_telegram_telegram_update_ibfk_10')->references(['id'])->on('vseprosto_telegram_poll');
            $table->foreign(['chosen_inline_result_id'], 'vseprosto_telegram_telegram_update_ibfk_6')->references(['id'])->on('vseprosto_telegram_chosen_inline_result');
            $table->foreign(['my_chat_member_updated_id'], 'vseprosto_telegram_telegram_update_ibfk_12')->references(['id'])->on('vseprosto_telegram_chat_member_updated');
            $table->foreign(['shipping_query_id'], 'vseprosto_telegram_telegram_update_ibfk_8')->references(['id'])->on('vseprosto_telegram_shipping_query');
            $table->foreign(['edited_message_id'], 'vseprosto_telegram_telegram_update_ibfk_2')->references(['id'])->on('vseprosto_telegram_edited_message');
            $table->foreign(['inline_query_id'], 'vseprosto_telegram_telegram_update_ibfk_5')->references(['id'])->on('vseprosto_telegram_inline_query');
            $table->foreign(['poll_answer_poll_id'], 'vseprosto_telegram_telegram_update_ibfk_11')->references(['poll_id'])->on('vseprosto_telegram_poll_answer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vseprosto_telegram_telegram_update', function (Blueprint $table) {
            $table->dropForeign('vseprosto_telegram_telegram_update_ibfk_7');
            $table->dropForeign('vseprosto_telegram_telegram_update_ibfk_13');
            $table->dropForeign('vseprosto_telegram_telegram_update_ibfk_9');
            $table->dropForeign('vseprosto_telegram_telegram_update_ibfk_3');
            $table->dropForeign('vseprosto_telegram_telegram_update_ibfk_1');
            $table->dropForeign('vseprosto_telegram_telegram_update_ibfk_4');
            $table->dropForeign('vseprosto_telegram_telegram_update_ibfk_10');
            $table->dropForeign('vseprosto_telegram_telegram_update_ibfk_6');
            $table->dropForeign('vseprosto_telegram_telegram_update_ibfk_12');
            $table->dropForeign('vseprosto_telegram_telegram_update_ibfk_8');
            $table->dropForeign('vseprosto_telegram_telegram_update_ibfk_2');
            $table->dropForeign('vseprosto_telegram_telegram_update_ibfk_5');
            $table->dropForeign('vseprosto_telegram_telegram_update_ibfk_11');
        });
    }
}
