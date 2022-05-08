<?php namespace VseProsto\Telegram\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;
use October\Rain\Database\Schema\Blueprint;

class CreateVseprostoTelegramInlineQueryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vseprosto_telegram_inline_query', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary()->comment('Unique identifier for this query');
            $table->bigInteger('user_id')->nullable()->index('user_id')->comment('Unique user identifier');
            $table->char('location')->nullable()->comment('Location of the user');
            $table->text('query')->comment('Text of the query');
            $table->char('offset')->nullable()->comment('Offset of the result');
            $table->char('chat_type')->nullable()->comment('Optional. Type of the chat, from which the inline query was sent.');
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
        Schema::dropIfExists('vseprosto_telegram_inline_query');
    }
}
