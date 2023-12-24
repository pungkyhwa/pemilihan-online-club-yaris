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
        Schema::create('capresma', function (Blueprint $table) {
            $table->id();
            $table->string('nm_capresma', 30);
            $table->string('wakil', 30);
            $table->text('visi');
            $table->text('misi');
            $table->string('fakultas',10);
            $table->text('foto_url');
            $table->integer('jumlah_vote');
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
        Schema::dropIfExists('capresmas');
    }
};
