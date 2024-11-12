<?php

use App\Enums\DirectionEnum;
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
        Schema::create('routes', function (Blueprint $table) {
            $table->id();
            $table->string('bus_number');
            $table->enum('direction', [
                DirectionEnum::DIRECTION_TO_START->value,
                DirectionEnum::DIRECTION_TO_END->value
            ]);
            $table->timestamps();

            $table->unique(['bus_number','direction']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('routes');
    }
};
