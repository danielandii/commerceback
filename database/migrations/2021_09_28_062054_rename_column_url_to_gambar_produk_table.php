<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameColumnUrlToGambarProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gambar_produk', function (Blueprint $table) {
            $table->renameColumn('url_gambar', 'is_thumbnail');
            $table->renameColumn('url_thumbnail', 'url_gambar');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gambar_produk', function (Blueprint $table) {
            //
        });
    }
}
