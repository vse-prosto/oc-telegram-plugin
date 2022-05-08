<?php namespace VseProsto\Telegram\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;
use October\Rain\Database\Schema\Blueprint;

class CreateVseprostoTelegramPollAnswerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vseprosto_telegram_poll_answer', function (Blueprint $table) {
            $table->unsignedBigInteger('poll_id')->comment('Unique poll identifier');
            $table->bigInteger('user_id')->comment('The user, who changed the answer to the poll');
            $table->text('option_ids')->comment('0-based identifiers of answer options, chosen by the user. May be empty if the user retracted their vote.');
            $table->timestamp('created_at')->nullable()->comment('Entry date creation');

            $table->primary(['poll_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vseprosto_telegram_poll_answer');
    }
}
