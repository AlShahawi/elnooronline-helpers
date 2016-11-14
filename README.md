# Installation
composer require elnooronline/helpers:dev-master
  

   .env  => Pusher Api Settings

      PUSHER_APP_ID=
      PUSHER_KEY=
      PUSHER_SECRET=
   
   config\app.php  --> providers array

        Collective\Html\HtmlServiceProvider::class,
        DaveJamesMiller\Breadcrumbs\ServiceProvider::class,
        Intervention\Image\ImageServiceProvider::class,
        AhmedFathy\Helpers\ServiceProvider::class,


  config\app.php  --> aliases array
  
        'Form' => Collective\Html\FormFacade::class,
        'Html' => Collective\Html\HtmlFacade::class,
        'Btn' => AhmedFathy\Helpers\Src\Btn::class,
        'bsForm' => AhmedFathy\Helpers\Src\bsForm::class,
        'langForm' => AhmedFathy\Helpers\Src\langForm::class,
        'MyRoute' => AhmedFathy\Helpers\Src\Routes\MyRoute::class,
        'Files' => AhmedFathy\Helpers\Src\Files\Files::class,
        'Control' => AhmedFathy\Helpers\Src\Control::class,
        'Breadcrumbs' => DaveJamesMiller\Breadcrumbs\Facade::class,
        'Notfication' => App\Http\Controllers\Functions\NotficationController::class,
        'Time' => App\Http\Controllers\Functions\TimeController::class,
        'Image' => Intervention\Image\Facades\Image::class,

 publish vendor 
 
         php artisan vendor:publish --force


   app\Console\Kernel.php

    protected $commands = [
        ...
        Commands\Controller::class,
        Commands\View::class,    
    ];

    
 app/Http/Kernel.php


       protected $middlewareGroups = [
        'web' => [
            ...
            \App\Http\Middleware\LocaleMiddleware::class,
            \App\Http\Middleware\NotficationMiddleware::class,
            \App\Http\Middleware\RemoveTempFilesUpload::class,
            \App\Http\Middleware\PermessionCheckMethods::class,
        ],

      protected $routeMiddleware = [
        ...
        'maintenance' => \App\Http\Middleware\maintenance::class,
        'rule' => \App\Http\Middleware\Rules::class,
        'Unauthorized' => \App\Http\Middleware\Unauthorized::class,
    ];

   app/Http/routes.php


        MyRoute::shareVariables();
         MyRoute::system();


         \MyRoute::auth();
         group(['prefix'=>cpanel,'middleware'=>'auth'],function(){
             get('/', 'Admin\HomeController@index','cpanel.home');
             get('delete/image/{id}', 'Settings\MainController@delete_files','settings.delete_files');
             get('settings/languages', 'Settings\LangController@index','lang.index');
             get('settings/main_settings', 'Settings\MainController@index','main.settings');
             post('settings/main_settings', 'Settings\MainController@store','main.settings.store');

             post('settings/lang/create', 'Settings\LangController@create','lang.create');
             post('settings/lang/{id}/edit', 'Settings\LangController@update','lang.edit');
             post('settings/lang/update_files', 'Settings\LangController@updateFiles','lang.updateFiles');
             post('settings/lang/flug', 'Settings\LangController@updateFlug','lang.updateFlug');
             post('settings/lang/delete', 'Settings\LangController@deleteLang','lang.deleteLang');

           resource('users','Admin\UserController','users');
           post('permession/{id}','Admin\UserController@permession_update','users.permession_update');
           get('profile','Admin\UserController@getEditProfile');
           post('profile','Admin\UserController@postEditProfile');

           get('notfications','Functions\NotficationController@live');
           get('notfications/see','Functions\NotficationController@seeOnClick');
           get('notfications/read_all','Functions\NotficationController@read_all');

           resource('pages','Admin\PageController','pages');
           resource('menus','Admin\MenuController','menus');
           resource('contacts','Admin\ContactController','contacts');
           resource('newsletters','Admin\NewsletterController','newsletters');
           resource('comments','Admin\CommentController','comments');
           resource('categories','Admin\CategoryController','categories');

           get('table/search','Admin\HomeController@search','cp.search');

         });
         post('files/upload','Settings\FileController@files_upload','files.files_upload');
         post('file/delete','Settings\FileController@delete','files.delete');
         get('file/delete/{id}','Settings\FileController@delete','files.delete');
         get('files/pagination','Settings\FileController@pagination','files.pagination');
         get('file/check/{id}','Settings\FileController@check','files.check');
         get('files-modal','Settings\FileController@getModal','files.getModal');
         post('comment/{extends}/{extends_id}/{parent}','Admin\CommentController@mainStore','comment.mainStore');

        ...

   database/seeds/DatabaseSeeder.php

    public function run()
    {
        ...
        $this->call(ContactSeeder::class);
        $this->call(LangsTableSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PageTabelSeeder::class);
        $this->call(MenuTabelSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        
    }

    
       composer dump-autoload
 
       php artisan migrate --seed

بعد الانتهاء من الخطوات السابقة ادخل على رابط 

  adminpanel 
  
وقم بتسجيل الدخول  بهذا الحساب

  user : info@elnooronline.com

  pass : 123456

