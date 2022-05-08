<?php namespace VseProsto\Telegram\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;
use October\Rain\Database\Schema\Blueprint;

class CreateVseprostoTelegramChatMemberUpdatedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vseprosto_telegram_chat_member_updated', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('Unique identifier for this entry');
            $table->bigInteger('chat_id')->index('chat_id')->comment('Chat the user belongs to');
            $table->bigInteger('user_id')->index('user_id')->comment('Performer of the action, which resulted in the change');
            $table->timestamp('date')->comment('Date the change was done in Unix time');
            $table->text('old_chat_member')->comment('Previous information about the chat member');
            $table->text('new_chat_member')->comment('New information about the chat member');
            $table->text('invite_link')->nullable()->comment('Chat invite link, which was used by the user to join the chat; for joining by invite link events only');
            $table->timestamp('created_at')->nullable()->comment('Entry date creation');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vseprosto_telegram_chat_member_updated');
    }
}
