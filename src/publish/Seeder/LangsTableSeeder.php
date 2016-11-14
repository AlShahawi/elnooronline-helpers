<?php

use Illuminate\Database\Seeder;

class LangsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       control()->seed('lang',[
            'name' => 'العربية',
            'code' => 'ar',
            'flug' => 'sa.png',
            'default' => 1
            ]);
        
    }
}
