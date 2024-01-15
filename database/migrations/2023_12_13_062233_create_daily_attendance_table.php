<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyAttendanceTable extends Migration
{
    public function up()
    {
        Schema::create('presensi_harian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users', 'id');
            $table->date('tanggal_absen');
            $table->timestamp('waktu_absen', 0)->default(now());
            $table->boolean('telat')->default(false);
            $table->integer('menit_telat')->nullable();
            $table->string('lokasi')->nullable();
            $table->double('latitude', 10, 6)->nullable();
            $table->double('longitude', 10, 6)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('presensi_harian');
    }
}