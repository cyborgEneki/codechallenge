<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $books = factory('App\Models\Book', 10)->create();

        App\Models\Author::all()->each(function ($authors) use ($books) {
            $authors->books()->attach(
                $books->random(rand(1, 3))->pluck('id')->toArray()
            );
        });

        foreach (range(1, 18) as $index) {
            $faker = Faker::create();
            DB::table('book_user')->insert([
                'date_out' => $faker->dateTimeBetween($startDate = '-1 month', $endDate = 'now', $timezone = null),
                'date_in' => $faker->dateTimeThisMonth($max = 'now', $timezone = null),
                'due_date' => $faker->optional()->dateTimeBetween($startDate = '-1 month', $endDate = '+1 month', $timezone = null),
                'book_id' => $faker->numberBetween($min = 1, $max = 10),
                'user_id' => $faker->numberBetween($min = 1, $max = 10),
            ]);
        }
    }
}
