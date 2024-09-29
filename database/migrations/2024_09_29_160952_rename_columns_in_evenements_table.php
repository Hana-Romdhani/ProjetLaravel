<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      
            DB::statement('ALTER TABLE evenements CHANGE titre title VARCHAR(255)');
            DB::statement('ALTER TABLE evenements CHANGE lieu location VARCHAR(255)');
      
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('evenements', function (Blueprint $table) {
            //
        });
    }
};
