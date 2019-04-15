<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory('App\Models\User', 10)->create();

        App\Models\Book::all()->each(function ($book) use ($users) {
            $book->users()->attach(
                $users->random(rand(1, 3))->pluck('id')->toArray()
    );
        });
    }
}
