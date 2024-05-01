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
        Schema::create('application', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->unsignedBigInteger('opp_id')->unsigned();
            $table->dateTime('application_date');
            $table->string('cv_link');
            $table->string('bio');

            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('opp_id')->references('id')->on('opportunity')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application');
    }
};
