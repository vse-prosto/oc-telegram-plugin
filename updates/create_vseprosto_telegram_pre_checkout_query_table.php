<?php namespace VseProsto\Telegram\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;
use October\Rain\Database\Schema\Blueprint;

class CreateVseprostoTelegramPreCheckoutQueryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vseprosto_telegram_pre_checkout_query', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary()->comment('Unique query identifier');
            $table->bigInteger('user_id')->nullable()->index('user_id')->comment('User who sent the query');
            $table->char('currency', 3)->nullable()->comment('Three-letter ISO 4217 currency code');
            $table->bigInteger('total_amount')->nullable()->comment('Total price in the smallest units of the currency');
            $table->char('invoice_payload')->default('')->comment('Bot specified invoice payload');
            $table->char('shipping_option_id')->nullable()->comment('Identifier of the shipping option chosen by the user');
            $table->text('order_info')->nullable()->comment('Order info provided by the user');
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
        Schema::dropIfExists('vseprosto_telegram_pre_checkout_query');
    }
}
