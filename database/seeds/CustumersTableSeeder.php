<?php

use Illuminate\Database\Seeder;

use NotiAPP\Models\Custumer;
use NotiAPP\Models\Address;

class CustumersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(NotiAPP\Models\Address::class,10)->create();

        echo "Salio";
    }
}
