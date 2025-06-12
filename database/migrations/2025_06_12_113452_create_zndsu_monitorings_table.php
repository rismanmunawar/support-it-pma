<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('zndsu_monitorings', function (Blueprint $table) {
            $table->id();
            $table->string('plant');
            $table->string('name');
            $table->json('statuses'); // tipe JSON
            $table->integer('jml_x')->default(0); // jumlah 'fail'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zndsu_monitorings');
    }
};
