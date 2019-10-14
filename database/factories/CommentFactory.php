<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use App\Post;
use App\User;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    $post = Post::query()->skip(rand(0, User::count() - 1))->first();
    $user = User::query()->skip(rand(0, User::count() - 1))->first();

    return [
        'post_id' => $post->id,
        'user_id' => $user->id,
        'text' => $faker->text,
    ];
});
