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

        factory(NotiAPP\Models\User::class,10)->create();

        // Insercion Directa 
        //DB::table('users')->insert([
        // 	'name' => 'Alex',
        // 	'fathers_last_name' => 'Medina'
        // 	]);
    }
}
