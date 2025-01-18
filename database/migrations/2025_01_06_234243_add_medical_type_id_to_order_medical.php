<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMedicalTypeIdToOrderMedical extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_medicals', function (Blueprint $table) {
            $table->integer('medical_type_id')->unsigned()->nullable();
            $table->foreign('medical_type_id')->references('id')->on('medical_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_medicals', function (Blueprint $table) {
            $table->dropColumn('medical_type_id'); // Ensures rollback works correctly
        });
    }
}
