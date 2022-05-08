<?php namespace VseProsto\Telegram\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;
use October\Rain\Database\Schema\Blueprint;

class CreateVseprostoTelegramEditedMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vseprosto_telegram_edited_message', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('Unique identifier for this entry');
            $table->bigInteger('chat_id')->nullable()->index('chat_id')->comment('Unique chat identifier');
            $table->unsignedBigInteger('message_id')->nullable()->index('message_id')->comment('Unique message identifier');
            $table->bigInteger('user_id')->nullable()->index('user_id')->comment('Unique user identifier');
            $table->timestamp('edit_date')->nullable()->comment('Date the message was edited in timestamp format');
            $table->text('text')->nullable()->comment('For text messages, the actual UTF-8 text of the message max message length 4096 char utf8');
            $table->text('entities')->nullable()->comment('For text messages, special entities like usernames, URLs, bot commands, etc. that appear in the text');
            $table->text('caption')->nullable()->comment('For message with caption, the actual UTF-8 text of the caption');

            $table->index(['chat_id', 'message_id'], 'chat_id_2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vseprosto_telegram_edited_message');
    }
}
