<?php

use Illuminate\Database\Seeder;
// use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::create([
        //     'name' => 'Zac Efron',
        //     'email' => 'zac@gmail.com',
        //     'password' => bcrypt('240693')
        // ]);
        // model factory
        factory(App\User::class, 4)->create();
    }
}
