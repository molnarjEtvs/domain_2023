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
        Schema::create('domainek', function (Blueprint $table) {
            $table->id("d_id");
            $table->string("domain_nev",30);
            $table->string("domain_nev_human",30);
            $table->date("lejarati_ido");
            $table->dateTime("rogzitesi_ido");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('domainek');
    }
};
