<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('product_id')->references('id')->on('products')->onDelete('restrict')->onUpdate('cascade');
            $table->string('title');
            $table->text('feedback');
            $table->foreignId('label_id')->references('id')->on('labels')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('action_id')->references('id')->on('actions')->onDelete('restrict')->onUpdate('cascade')->default(null);
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
        Schema::dropIfExists('feedback');
    }
}
