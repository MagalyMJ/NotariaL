<?php

use Illuminate\Database\Seeder;

use NotiAPP\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * lo unico que hacen es insertar o manipular los daots en una bd de estado 
     * inicial
     * @return void
     */
    public function run()
    {
        // seria para siempre tener un numero determinado 
        // User::truncate();

        //factory(NotiAPP\Models\User::class,10)->create();

        // Insercion Directa 
        DB::table('users')->insert([
        'name' => 'tester',
        'fathers_last_name' => 'tester',
        'mothers_last_name' => 'tester',
        'user_name' => 'tester',
        'user_type' => 1,
        'email' => 'tester@gmail.com',
        'password' => bcrypt('123456789'),
        'remember_token' => str_random(10),
         	]);
    }
}
