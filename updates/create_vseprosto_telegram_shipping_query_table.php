<?php namespace VseProsto\Telegram\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;
use October\Rain\Database\Schema\Blueprint;

class CreateVseprostoTelegramShippingQueryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vseprosto_telegram_shipping_query', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary()->comment('Unique query identifier');
            $table->bigInteger('user_id')->nullable()->index('user_id')->comment('User who sent the query');
            $table->char('invoice_payload')->default('')->comment('Bot specified invoice payload');
            $table->char('shipping_address')->default('')->comment('User specified shipping address');
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
        Schema::dropIfExists('vseprosto_telegram_shipping_query');
    }
}
