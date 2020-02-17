<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\PostStatus;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("category_id");

            $table->string("title");
            $table->string("slug")->index();

            $table->string("cover_path");
            $table->longText("content");

            $table->unsignedBigInteger("user_id");
            $table->unsignedInteger("visits")->default(0);

            $table->unsignedTinyInteger('status')->default(PostStatus::Acting);
            $table->softDeletes();

            $table->timestamps();

            $table->foreign("category_id")->references("id")->on("categories")->onDelete("cascade");
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");

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
}
