<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;
use App\Enums\PostStatus;

$factory->define(Post::class, function (Faker $faker) {
    $title = $faker->sentence;
    $user_ids = App\User::pluck('id');
    $category_ids = App\Category::pluck('id');

    return [
        "title" => $title,
        "slug"  => \Illuminate\Support\Str::slug($title),
        "content"  => $faker->text,
        "category_id" => $category_ids->random(),
        "user_id" => $user_ids->random(),
        "status" =>  $faker->randomElement($array = PostStatus::getValues()),
        "cover_path" => asset("storage/covers/cover.jpg"),
        "visits" => 0
    ];
});
