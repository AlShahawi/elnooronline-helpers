<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for ($i=1; $i < 6; $i++) 
        { 
           control()->seed('category',[
                    'translate' => [
                        'name'=>'قسم '.$i,
                        'info'=>'المحتوى '.$i,
                    ],
                ]);
        }

    }
}
