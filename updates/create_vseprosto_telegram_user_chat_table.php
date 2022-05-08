<?php namespace VseProsto\Telegram\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;
use October\Rain\Database\Schema\Blueprint;

class CreateVseprostoTelegramUserChatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vseprosto_telegram_user_chat', function (Blueprint $table) {
            $table->bigInteger('user_id')->comment('Unique user identifier');
            $table->bigInteger('chat_id')->index('chat_id')->comment('Unique user or chat identifier');

            $table->primary(['user_id', 'chat_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vseprosto_telegram_user_chat');
    }
}
