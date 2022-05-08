<?php namespace VseProsto\Telegram\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;
use October\Rain\Database\Schema\Blueprint;

class CreateVseprostoTelegramPollTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vseprosto_telegram_poll', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary()->comment('Unique poll identifier');
            $table->text('question')->comment('Poll question');
            $table->text('options')->comment('List of poll options');
            $table->unsignedInteger('total_voter_count')->nullable()->comment('Total number of users that voted in the poll');
            $table->boolean('is_closed')->nullable()->default(false)->comment('True, if the poll is closed');
            $table->boolean('is_anonymous')->nullable()->default(true)->comment('True, if the poll is anonymous');
            $table->char('type')->nullable()->comment('Poll type, currently can be “regular” or “quiz”');
            $table->boolean('allows_multiple_answers')->nullable()->default(false)->comment('True, if the poll allows multiple answers');
            $table->unsignedInteger('correct_option_id')->nullable()->comment('0-based identifier of the correct answer option. Available only for polls in the quiz mode, which are closed, or was sent (not forwarded) by the bot or to the private chat with the bot.');
            $table->string('explanation')->nullable()->comment('Text that is shown when a user chooses an incorrect answer or taps on the lamp icon in a quiz-style poll, 0-200 characters');
            $table->text('explanation_entities')->nullable()->comment('Special entities like usernames, URLs, bot commands, etc. that appear in the explanation');
            $table->unsignedInteger('open_period')->nullable()->comment('Amount of time in seconds the poll will be active after creation');
            $table->timestamp('close_date')->nullable()->comment('Point in time (Unix timestamp) when the poll will be automatically closed');
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
        Schema::dropIfExists('vseprosto_telegram_poll');
    }
}
