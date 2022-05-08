<?php namespace VseProsto\Telegram\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;
use October\Rain\Database\Schema\Blueprint;

class CreateVseprostoTelegramConversationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(' vseprosto_telegram_conversation', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('Unique identifier for this entry');
            $table->bigInteger('user_id')->nullable()->index('user_id')->comment('Unique user identifier');
            $table->bigInteger('chat_id')->nullable()->index('chat_id')->comment('Unique user or chat identifier');
            $table->enum('status', ['active', 'cancelled', 'stopped'])->default('active')->index('status')->comment('Conversation state');
            $table->string('command', 160)->nullable()->default('')->comment('Default command to execute');
            $table->text('notes')->nullable()->comment('Data stored from command');
            $table->timestamp('created_at')->nullable()->comment('Entry date creation');
            $table->timestamp('updated_at')->nullable()->comment('Entry date update');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(' vseprosto_telegram_conversation');
    }
}
