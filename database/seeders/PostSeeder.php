<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use Faker;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {

            Post::create([
                'nombres' => $faker->name,
                'estado' => $faker->randomElement($array = array ('ACTIVO','CANCELADO'))
            ]);

          }
    }
}
