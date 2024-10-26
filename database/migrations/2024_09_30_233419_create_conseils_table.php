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
        Schema::create('conseils', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('question');
            $table->longText(column: 'contenus');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('category_id'); // Ensure this is unsigned big integer to match the primary key of CategorieConseil
            $table->string('image_url')->nullable();
            $table->string('video_url')->nullable();
            $table->integer('rating_count')->default(0); // To count the number of ratings
            $table->decimal('total_rating', 8, 2)->default(0);
            $table->json('rated_by_users')->nullable();
            $table->timestamps();

            // Define the foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categorie_conseils')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('conseils', function (Blueprint $table) {
            $table->dropForeign(['category_id']); // Drop the foreign key first
            $table->dropForeign(['user_id']);
            $table->dropColumn('rated_by_users');
        });
        Schema::dropIfExists('conseils');
    }
};
