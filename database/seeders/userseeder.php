<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class userseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('users')->insert([
            [
                'name' => 'User One',
                'email' => 'one@kamsware.co.ke',
                'password' => bcrypt(123456)
            ],
           [
                'name' => 'User Two',
                'email' => 'two@kamsware.co.ke',
                'password' => bcrypt(123456)
            ],
        ]);
    }
}
