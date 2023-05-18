<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venues', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->integer("owner")->default(0)->nullable();
            $table->string("phone");
            $table->string("email");
            $table->string("url_handle")->unique();
            $table->string("logo");
            $table->string("plan_price")->default(150);
            $table->string("menu_plan_price")->default(null);
            $table->boolean("timeline_organizer")->default(0);
            $table->boolean("menu_designer")->default(0);
            $table->boolean("is_active")->default(1);
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
        Schema::dropIfExists('venues');
    }
};
