<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTahananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tahanan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id');
            $table->string('nama_lengkap', 100)->nullable();
            $table->string('ttl', 150)->nullable();
            $table->text('alamat')->nullable();
            $table->string('jenis_kelamin', 50)->nullable();
            $table->string('agama', 50)->nullable();
            $table->string('kewarganegaraan', 50)->nullable();
            $table->text('tindak_pidana')->nullable();
            $table->text('hukuman')->nullable();
            $table->string('residivis', 10)->nullable()->default('tidak');
            $table->string('berapa_residivis', 50)->nullable();
            $table->string('score', 100)->nullable();
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
        Schema::dropIfExists('tahanan');
    }
}
