<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('time_distance_presets', function (Blueprint $table) {
            $table->id();
            $table->integer('workout_id');
            $table->integer('distance');
            $table->time('time');
            $table->timestamps();
        });



        DB::table('time_distance_presets')->insert([
            'id'        => 1,
            'workout_id'=> 1,
            'distance'  => 0,
            'time'      => '00:40:00',
        ]);
        DB::table('time_distance_presets')->insert([
            'id'        => 2,
            'workout_id'=> 1,
            'distance'  => 0,
            'time'      => '00:40:00',
        ]);
        DB::table('time_distance_presets')->insert([
            'id'        => 3,
            'workout_id'=> 2,
            'distance'  => 5000,
            'time'      => '00:00:00',
        ]);
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('time_distance_presets');
    }
};
