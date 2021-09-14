<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnUlasanIdToTokoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('toko', function (Blueprint $table) {
            $table->dropColumn('ulasan_id');
            $table->text('deskripsi')->change();
            $table->float('rating')->nullable()->default(0.0)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('toko', function (Blueprint $table) {
            $table->string('ulasan_id')->after('id');
        });
    }
}
