<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisingCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertising_campaigns', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->date("from");
            $table->date("to");
            $table->float("total_budget",12,2);
            $table->float("daily_budget",12,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advertising_campaigns');
    }
}
