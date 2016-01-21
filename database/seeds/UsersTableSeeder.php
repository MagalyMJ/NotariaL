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
        $user->name = "Herminio Ivan";
        $user->fathers_last_name = "Ventura";
        $user->mothers_last_name = "Moreno";
        $user->user_name= "ivan07";
        $user->email="ivanvent@hotmail.com";
        $user->password = bcrypt('90Ntrstd');
        $user->remember_token = str_random(10);
        $user->save();
        $user->attachRole(2);
        $user->save();

        $user = new User();
        $user->name = "Joel Enrique";
        $user->fathers_last_name = "Montoya";
        $user->mothers_last_name = "García";
        $user->user_name= "joel04";
        $user->email="joel@gmail.com";
        $user->password = bcrypt('7haVr5fr');
        $user->remember_token = str_random(10);
        $user->save();
        $user->attachRole(2);
        $user->save();

        $user = new User();
        $user->name = "Laura Tayde";
        $user->fathers_last_name = "Ventura";
        $user->mothers_last_name = "López";
        $user->user_name= "taide10";
        $user->email="taideventura@hotmail.com";
        $user->password = bcrypt('6grYfa8r');
        $user->remember_token = str_random(10);
        $user->save();
        $user->attachRole(2);
        $user->save();

        $user = new User();
        $user->name = "Juan Carlos";
        $user->fathers_last_name = "de Luna";
        $user->mothers_last_name = "Esquivel";
        $user->user_name= "juanC06";
        $user->email="juandelunae79@gmail.com";
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

        $user = new User();
        $user->name = "Veronica Elisabeth";
        $user->fathers_last_name = "Barba";
        $user->mothers_last_name = "Perez";
        $user->user_name = "vero05";
        $user->email="veronica.lizi@hotmail.com";
        $user->password = bcrypt('5shr6HrT');
        $user->remember_token = str_random(10);
        $user->save();
        $user->attachRole(3);
        $user->save();
    }
}
