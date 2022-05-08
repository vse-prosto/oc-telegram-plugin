<?php namespace VseProsto\Telegram\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;
use October\Rain\Database\Schema\Blueprint;

class CreateVseprostoTelegramRequestLimiterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(' vseprosto_telegram_request_limiter', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('Unique identifier for this entry');
            $table->char('chat_id')->nullable()->comment('Unique chat identifier');
            $table->char('inline_message_id')->nullable()->comment('Identifier of the sent inline message');
            $table->char('method')->nullable()->comment('Request method');
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
        Schema::dropIfExists(' vseprosto_telegram_request_limiter');
    }
}
