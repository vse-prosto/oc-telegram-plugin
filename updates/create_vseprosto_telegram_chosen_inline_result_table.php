<?php namespace VseProsto\Telegram\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;
use October\Rain\Database\Schema\Blueprint;

class CreateVseprostoTelegramChosenInlineResultTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vseprosto_telegram_chosen_inline_result', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('Unique identifier for this entry');
            $table->char('result_id')->default('')->comment('The unique identifier for the result that was chosen');
            $table->bigInteger('user_id')->nullable()->index('user_id')->comment('The user that chose the result');
            $table->char('location')->nullable()->comment('Sender location, only for bots that require user location');
            $table->char('inline_message_id')->nullable()->comment('Identifier of the sent inline message');
            $table->text('query')->comment('The query that was used to obtain the result');
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
        Schema::dropIfExists('vseprosto_telegram_chosen_inline_result');
    }
}
