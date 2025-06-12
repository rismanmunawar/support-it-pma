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
        Schema::create('monitoring_zndsu', function (Blueprint $table) {
            $table->id();
            $table->string('plant');
            $table->string('name');
            $table->integer('jml_x')->nullable();

            // Tambahkan kolom day_1 sampai day_31
            for ($i = 1; $i <= 31; $i++) {
                $table->string('day_' . $i)->nullable();
            }

            $table->timestamp('uploaded_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monitoring_zndsu');
    }
};
