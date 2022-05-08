<?php namespace VseProsto\Telegram\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;
use October\Rain\Database\Schema\Blueprint;

class CreateVseprostoTelegramTelegramUpdateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vseprosto_telegram_telegram_update', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary()->comment('Update\'s unique identifier');
            $table->bigInteger('chat_id')->nullable()->comment('Unique chat identifier');
            $table->unsignedBigInteger('message_id')->nullable()->index('message_id')->comment('New incoming message of any kind - text, photo, sticker, etc.');
            $table->unsignedBigInteger('edited_message_id')->nullable()->index('edited_message_id')->comment('New version of a message that is known to the bot and was edited');
            $table->unsignedBigInteger('channel_post_id')->nullable()->index('channel_post_id')->comment('New incoming channel post of any kind - text, photo, sticker, etc.');
            $table->unsignedBigInteger('edited_channel_post_id')->nullable()->index('edited_channel_post_id')->comment('New version of a channel post that is known to the bot and was edited');
            $table->unsignedBigInteger('inline_query_id')->nullable()->index('inline_query_id')->comment('New incoming inline query');
            $table->unsignedBigInteger('chosen_inline_result_id')->nullable()->index('chosen_inline_result_id')->comment('The result of an inline query that was chosen by a user and sent to their chat partner');
            $table->unsignedBigInteger('callback_query_id')->nullable()->index('callback_query_id')->comment('New incoming callback query');
            $table->unsignedBigInteger('shipping_query_id')->nullable()->index('shipping_query_id')->comment('New incoming shipping query. Only for invoices with flexible price');
            $table->unsignedBigInteger('pre_checkout_query_id')->nullable()->index('pre_checkout_query_id')->comment('New incoming pre-checkout query. Contains full information about checkout');
            $table->unsignedBigInteger('poll_id')->nullable()->index('poll_id')->comment('New poll state. Bots receive only updates about polls, which are sent or stopped by the bot');
            $table->unsignedBigInteger('poll_answer_poll_id')->nullable()->index('poll_answer_poll_id')->comment('A user changed their answer in a non-anonymous poll. Bots receive new votes only in polls that were sent by the bot itself.');
            $table->unsignedBigInteger('my_chat_member_updated_id')->nullable()->index('my_chat_member_updated_id')->comment('The bot\'s chat member status was updated in a chat. For private chats, this update is received only when the bot is blocked or unblocked by the user.');
            $table->unsignedBigInteger('chat_member_updated_id')->nullable()->index('chat_member_updated_id')->comment('A chat member\'s status was updated in a chat. The bot must be an administrator in the chat and must explicitly specify “chat_member” in the list of allowed_updates to receive these updates.');

            $table->index(['chat_id', 'channel_post_id'], 'chat_id');
            $table->index(['chat_id', 'message_id'], 'chat_message_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vseprosto_telegram_telegram_update');
    }
}
