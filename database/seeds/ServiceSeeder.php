<?php

use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        echo "Entra";
        factory(NotiAPP\Models\Service::class,10)->create()->each(function ($service){
            
            $expense = factory(NotiAPP\Models\Expense::class)->make();
          	$documet = factory(NotiAPP\Models\Document::class)->make();
            
             $service->documents()->save($expense);
           $service->expenses()->save($documet);
        });
        echo "listo";
    }
}
