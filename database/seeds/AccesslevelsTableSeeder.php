<?php

use Illuminate\Database\Seeder;

class AccesslevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accesslevels')->insert([
            'name' => 'Admin',
        ]);      

        DB::table('accesslevels')->insert([
            'name' => 'Regular',
        ]);               
    }
}
