<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeInventoryIdInLoansToOndeleteNull extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->dropForeign('loans_inventory_id_foreign');
            $table->foreign('inventory_id')->references('id')->on('inventories')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->foreign('inventory_id')->references('id')->on('inventories')->onDelete('cascade');
        });
    }
}
