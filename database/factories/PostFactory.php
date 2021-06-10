<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use App\User;
use Faker\Generator as Faker;
use Faker\Provider\Image;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

$factory->define(Post::class, function (Faker $faker) {
    $user = User::query()->skip(rand(0, User::count() - 1))->first();

    $image = null;
    if ((bool) rand(0, 2)) {
        $faker->addProvider(new Image($faker));
        $path = $faker->image(null, 640, 480, rand(0, 1) ? 'food' : 'cats', true, true, 'Placeholder');

        $image = Storage::disk('public')->putFile('posts', new File($path));
    }

    return [
        'user_id' => $user->id,
        'text' => $faker->text,
        'file_path' => $image,
    ];
});
