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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class); // user_id
            $table->foreignIdFor(\App\Models\Category::class); // category_id
            $table->string('title');
            $table->text('image');
            $table->text('description');
            $table->string('color')->nullable();
            $table->string('brand')->nullable();
            $table->dateTime('datetime')->nullable()->default(null); // lost time and found time
            $table->double('reward')->nullable()->default(0);
            $table->boolean('is_lost');
            $table->boolean('is_done')->default(false);
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->boolean('hidden')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
