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

        factory(NotiAPP\Models\Customer::class,10)->create()->each(function ($custumer){
            
            $address = factory(NotiAPP\Models\Address::class)->make();
            
            $custumer->address()->save($address);
        });

    }
}
