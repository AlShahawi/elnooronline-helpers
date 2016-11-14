<?php

use Illuminate\Database\Seeder;

class PageTabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        control()->seed('page',[
                'translate' => [
                    'name'=>'الرئيسية',
                ],
                'active' => 1,
                'out_url' => 'http://localhost/mysite',
            ]);

        control()->seed('page',[
                'translate' => [
                    'name'=>'من نحن',
                    'content'=>'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص',
                ],
                'active' => 1,
            ]); 
        
        control()->seed('page',[
                'translate' => [
                    'name'=>'اتصل بنا',
                ],
                'active' => 1,
                'out_url' => 'http://localhost/mysite/contacts',
            ]); 

    }
}
