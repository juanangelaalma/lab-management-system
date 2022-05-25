<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        if(!Schema::hasTable('inventories')){
            Schema::create('inventories', function (Blueprint $table) {
                $table->id();
                $table->string('item_code', 25)->unique();
                $table->unsignedBigInteger('category_id');
                $table->string('name', 25);
                $table->enum('status', ['used', 'unused'])->default('unused');
                $table->enum('condition', ['good', 'bad'])->default('good');
                $table->text('description')->nullable();
                $table->timestamps();
    
                $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventories');
    }
}
