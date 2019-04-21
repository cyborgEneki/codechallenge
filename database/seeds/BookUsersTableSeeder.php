<?php

use Illuminate\Database\Seeder;

class BookUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $books = factory('App\Models\BookUser', 10)->create();        
    }
}
