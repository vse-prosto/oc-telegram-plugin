<?php namespace VseProsto\Telegram\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;
use October\Rain\Database\Schema\Blueprint;

class CreateVseprostoTelegramUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vseprosto_telegram_user', function (Blueprint $table) {
            $table->bigInteger('id')->primary()->comment('Unique identifier for this user or bot');
            $table->boolean('is_bot')->nullable()->default(false)->comment('True, if this user is a bot');
            $table->char('first_name')->default('')->comment('User\'s or bot\'s first name');
            $table->char('last_name')->nullable()->comment('User\'s or bot\'s last name');
            $table->char('username', 191)->nullable()->index('username')->comment('User\'s or bot\'s username');
            $table->char('language_code', 10)->nullable()->comment('IETF language tag of the user\'s language');
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
        Schema::dropIfExists('vseprosto_telegram_user');
    }
}
