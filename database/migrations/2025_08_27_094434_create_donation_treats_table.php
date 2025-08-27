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
        Schema::create('donation_treats', function (Blueprint $table) {
            $table->id();
            $table->string('campaign_id', 255);
            $table->string('campaign_name', 255);
            $table->string('campaign_url', 255);
            $table->string('campaign_username', 255);
            $table->string('reward_id', 255);
            $table->string('name', 500);
            $table->text('description');
            $table->integer('cost');
            $table->string('image', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donation_treats');
    }
};
