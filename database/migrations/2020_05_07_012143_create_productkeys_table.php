<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductkeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productkeys', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('importproduct_id');
            $table->foreign('importproduct_id')->references('id')->on('importproducts');
            $table->string('key');
            $table->integer('status')->default(1);
            $table->integer('active')->default(0);
            $table->boolean('is_delete')->default(false);
            $table->timestamp('deleted_at')->nullable();
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
        Schema::dropIfExists('productkeys');
    }
}
