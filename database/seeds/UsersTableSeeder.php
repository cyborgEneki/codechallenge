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
        DB::table('users')->insert([
            'first_name' => 'Test',
            'last_name' => 'Eneki',
            'email' => 'eneki@email.com',
            'password' => Hash::make('123456'),
            'max_number_of_books_allowed' => 3,
            'status' => 1,
            'department_id' => 1,
            'accesslevel_id' => 1
        ]);

        DB::table('users')->insert([
            'first_name' => 'Test',
            'last_name' => 'Voldermort',
            'email' => 'voldermort@email.com',
            'password' => Hash::make('123456'),
            'max_number_of_books_allowed' => 3,
            'status' => 1,
            'department_id' => 1,
            'accesslevel_id' => 2
        ]);

        $users = factory('App\Models\User', 10)->create();

        App\Models\Book::all()->each(function ($book) use ($users) {
            $book->users()->attach(
                $users->random(rand(1, 3))->pluck('id')->toArray()
    );
        });
    }
}
