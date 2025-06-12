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
        Schema::table('zndsu_monitorings', function (Blueprint $table) {
            $table->json('status_headers')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('zndsu_monitorings', function (Blueprint $table) {
            $table->dropColumn('status_headers');
        });
    }
};
