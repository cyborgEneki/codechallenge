<?php

use Illuminate\Database\Seeder;

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
        
        App\Models\Authors::all()->each(function ($authors) use ($books) {
            $authors->books()->attach(
                $books->random(rand(1, 3))->pluck('id')->toArray()
    );
        });

        App\Models\Users::all()->each(function ($users) use ($books) {
            $users->books()->attach(
                $books->random(rand(1, 3))->pluck('id')->toArray()
    );
        });
    }
}
