<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageToZapatillasTable extends Migration
{
    public function up()
    {
        Schema::table('zapatillas', function (Blueprint $table) {
            $table->string('image')->nullable();
        });
    }

    public function down()
    {
        Schema::table('zapatillas', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
}
