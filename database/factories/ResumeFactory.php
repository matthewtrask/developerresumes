<?php

use App\Models\Resume;
use Faker\Generator as Faker;

$factory->define(Resume::class, function (Faker $faker) {
    return [
        'user_id'    => $faker->numberBetween(1, 100),
        'resume'     => 'fake/file/path.doc',
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
    ];
});
