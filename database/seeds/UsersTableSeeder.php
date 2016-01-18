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

        $user = new User();
        $user->name = "Beto";
        $user->fathers_last_name = "Araiza";
        $user->mothers_last_name = "";
        $user->user_name = "beto13";
        $user->email = "betoaraiza7@gmail.com";
        $user->password = bcrypt('123456789');
        $user->remember_token = str_random(10);
        $user->save();
        $user->attachRole(2);
        $user->save();

        $user = new User();
        $user->name = "Ivan";
        $user->fathers_last_name = "";
        $user->mothers_last_name = "";
        $user->user_name= "ivan07";
        $user->email="ivan@gmail.com";
        $user->password = bcrypt('90Ntrstd');
        $user->remember_token = str_random(10);
        $user->save();
        $user->attachRole(2);
        $user->save();

        $user = new User();
        $user->name = "Joel";
        $user->fathers_last_name = "";
        $user->mothers_last_name = "";
        $user->user_name= "joel04";
        $user->email="ivan@gmail.com";
        $user->password = bcrypt('7haVr5fr');
        $user->remember_token = str_random(10);
        $user->save();
        $user->attachRole(2);
        $user->save();

        $user = new User();
        $user->name = "Taide";
        $user->fathers_last_name = "";
        $user->mothers_last_name = "";
        $user->user_name= "taide10";
        $user->email="ivan@gmail.com";
        $user->password = bcrypt('6grYfa8r');
        $user->remember_token = str_random(10);
        $user->save();
        $user->attachRole(2);
        $user->save();

        $user = new User();
        $user->name = "Juan Carlos";
        $user->fathers_last_name = "";
        $user->mothers_last_name = "";
        $user->user_name= "juanC06";
        $user->email="ivan@gmail.com";
        $user->password = bcrypt('3hrDf28r');
        $user->remember_token = str_random(10);
        $user->save();
        $user->attachRole(2);
        $user->save();


        $user = new User();
        $user->name = "tester";
        $user->fathers_last_name = "tester";
        $user->mothers_last_name = "tester";
        $user->user_name= "tester";
        $user->email="test@gmail.com";
        $user->password = bcrypt('123456789');
        $user->remember_token = str_random(10);
        $user->save();
        $user->attachRole(1);
        $user->save();

        $user = new User();
        $user->name = "user";
        $user->fathers_last_name = "user";
        $user->mothers_last_name = "user";
        $user->user_name = "user";
        $user->email="user@gmail.com";
        $user->password = bcrypt('123456789');
        $user->remember_token = str_random(10);
        $user->save();
        $user->attachRole(3);
        $user->save();
    }
}
