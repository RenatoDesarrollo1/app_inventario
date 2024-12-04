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
        Schema::create('inv_environments', function (Blueprint $table) {
            $table->ulid("id")->primary()->unique();
            $table->string('name')->unique();
            $table->string('address')->nullable();
            $table->boolean("state")->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inv_environments');
    }
};
