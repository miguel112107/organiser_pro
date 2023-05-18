<?php

use Carbon\Traits\Timestamp;
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
        Schema::create('timelines', function (Blueprint $table) {
            $table->id();
            $table->string("person1_firstname")->nullable();
            $table->string("person1_lastname")->nullable();
            $table->string("person2_firstname")->nullable();
            $table->string("person3_lastname")->nullable();
            $table->string("url_handle")->nullable();
            $table->string("person1_email")->nullable();
            $table->string("person2_email")->nullable();
            $table->string("person1_cell")->nullable();
            $table->string("person2_cell")->nullable();
            $table->integer("package_choice")->nullable();
            $table->integer("user")->nullable();
            $table->integer("venue")->nullable();
            $table->date("checkin_date")->nullable();
            $table->date("wedding_date")->nullable();
            $table->date("checkout_date")->nullable();
            $table->string("arrival_time_notes")->nullable();
            $table->string("parent_names")->nullable();
            $table->integer("guest_headcount_adults")->nullable();
            $table->integer("guest_headcount_children")->nullable();
            $table->integer("wedding_party_size")->nullable();
            $table->string("day_of_contact")->nullable();
            $table->boolean("first_look")->nullable();
            $table->integer("ceremony_location")->nullable();
            $table->text("ceremony_notes")->nullable();
            $table->time("ceremony_time")->nullable();
            $table->string("ceremony_length")->nullable();
            $table->time("cocktail_reception_time")->nullable();
            $table->text("reception_notes")->nullable();
            $table->boolean("grand_entrance")->nullable();
            $table->string("parent_child_dance")->nullable();
            $table->text("layout_notes")->nullable();
            $table->text("entertainment_notes")->nullable();
            $table->text("dance_floor_notes")->nullable();
            $table->string("cake_display")->nullable();
            $table->string("dessert_display")->nullable();
            $table->integer("linens_napkins")->nullable();
            $table->string("chargers")->nullable();
            $table->integer("table_layout_couple")->nullable();
            $table->integer("table_layout_guests")->nullable();
            $table->text("table_layout_notes")->nullable();
            $table->string("lawn_games")->nullable();
            $table->string("patio_fire_rings")->nullable();
            $table->string("bar_plan")->nullable();
            $table->string("bar_service_pause")->nullable();
            $table->string("signature_cocktails")->nullable();
            $table->time("dinner_service_time")->nullable();
            $table->string("intro_speech_dance")->nullable();
            $table->integer("dinner_service_style")->nullable();
            $table->text("breakfast")->nullable();
            $table->text("farewell_brunch")->nullable();
            $table->text("late_night_snack")->nullable();
            $table->boolean("rehearsal_barn")->nullable();
            $table->date("rehearsal_date")->nullable();
            $table->integer("rehearsal_guests")->nullable();
            $table->boolean("rehearsal_bar")->nullable();
            $table->text("rehearsal_dinner_notes")->nullable();
            $table->boolean("severe_allergies")->nullable();
            $table->text("severe_allergy_notes")->nullable();
            $table->string("special_diet_needs")->nullable();
            $table->boolean("is_active")->default(1);
            $table->boolean("is_locked")->default(0);
            $table->boolean("is_archived")->default(0);
            $table->date("archived_date")->default(null);
            $table->integer("staff_update_user")->default(0);
            $table->date("staff_update_date")->default(null);
            $table->date("user_update_date")->default(null);
            $table->date("superAdmin_update_date")->default(null);
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
        Schema::dropIfExists('timelines');
    }
};
