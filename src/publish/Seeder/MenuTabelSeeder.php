<?php

use Illuminate\Database\Seeder;

class MenuTabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <= 3 ; $i++) 
        { 
	        control()->seed('menu',[
                'page_id' => $i,
                'position' => 'header',
            ]);
        }

		
    }
}
