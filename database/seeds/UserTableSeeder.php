<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Geraldine',
            'email' => 'gericyber@gmail.com',
            'password' => bcrypt('240693'),
            'admin' => true
        ]);
        // model factory
        factory(App\User::class, 4)->create();
    }
}
