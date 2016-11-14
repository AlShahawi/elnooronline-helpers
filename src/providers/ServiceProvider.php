<?php

namespace AhmedFathy\Helpers;

use Illuminate\Support\ServiceProvider as Provider;
use Illuminate\Database\Eloquent\Relations\Relation;
class ServiceProvider extends Provider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (file_exists(app_path('Http/helpers/helpers.php'))) 
        {
            @require_once app_path('Http/helpers/helpers.php');
        }
        if (class_exists(\App\Setting::class)
           && class_exists(\App\Language::class)
           && class_exists(\App\Lang::class)
           && class_exists(\App\File::class)) 
        {
            $this->allFilesInPath(__DIR__.'/../helpers/src');
        }

        \Blade::directive('translate', function($form,$lang=null,$row=null) {
            $args = explode(',',$form);
            $use = $args[count($args)-1];
            if (count($args) > 2) {
            unset($args[count($args)-1]);
            $args[count($args)-1] = $args[count($args)-1].')';
            $use = '('.$use;
                # code...
            }

            if (count($args) > 1 ) {
            $args = implode(',',$args);
            $code = "<?php echo bsForm::translate(function{$args} use{$use}{ ?>";
            }else{
            $args = implode(',',$args);
                
            $code = "<?php echo bsForm::translate(function{$args}{ ?>";
            }
            return $code;
        });


        \Blade::directive('endtranslate', function() {
            return "<?php }); ?>";
        });




    }
    private function getArguments($argumentString)
    {
        return explode(', ', str_replace(['(', ')'], '', $argumentString));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        /* Relation Morph Map */
        $dir = app_path();
        $files = scandir($dir);

        $models = [];
        $namespace = 'App\\';
        foreach($files as $file) {
            if (is_file($dir.'/'.$file)) 
            {
            $models[

                strtolower(str_plural(snake_case(str_replace('.php','', $file)),'_'))

                ] = $namespace . str_replace('.php','', $file);
            }
        }

        Relation::morphMap($models);
        /* /Relation Morph Map */

app()->singleton('pusher',function(){
            return new \AhmedFathy\Helpers\Src\Pusher();
        });
        $this->publishes([
        __DIR__.'/../publish/Controllers/' => app_path('Http/Controllers')
        ], 'controller');



        $this->publishes([
        __DIR__.'/../publish/Model.php' => base_path('vendor/laravel/framework/src/Illuminate/Database/Eloquent/Model.php')
        ], 'model');

        $this->publishes([
        __DIR__.'/../publish/AhmedFathyHelpers.php' => app_path('Http/Variables/shareVariables.php')
        ], 'variables');
        
        $this->publishes([
        __DIR__.'/../publish/notfication.php' =>config_path('notfication.php')
        ], 'config');
        

        $this->publishes([
        __DIR__.'/../publish/config' =>config_path()
        ], 'config');
        
        
        $this->publishes([
        __DIR__.'/../publish/migrations/' => database_path('migrations')
        ], 'migrations');

        $this->publishes([
        __DIR__.'/../publish/Models/' => app_path()
        ], 'models');

        $this->publishes([
        __DIR__.'/../publish/Seeder/' => database_path('seeds')
        ], 'seeds');

        $this->publishes([
        __DIR__.'/../publish/middleware/' => app_path('Http/Middleware')
        ], 'middlewares');

        $this->publishes([
        __DIR__.'/../publish/console/' => app_path('Console')
        ], 'console');

        $this->publishes([
        __DIR__.'/../publish/lang/' => base_path('resources/lang')
        ], 'lang');

        $this->publishes([
        __DIR__.'/../publish/public/' => public_path()
        ], 'public');

        $this->publishes([
        __DIR__.'/../publish/views/' => base_path('resources/views')
        ], 'views');
        
        $this->publishes([
        __DIR__.'/../publish/bootstrap3.blade.php' => base_path('vendor/davejamesmiller/laravel-breadcrumbs/views/bootstrap3.blade.php')
        ], 'bootstrap3');



    }
    public function allFilesInPath($path)
    {
        $dir = scandir($path);
            for ($i=2; $i <count($dir); $i++) 
            {
                $data =  $path.'/'.$dir[$i];
                if (is_dir($data)) 
                {
                    $this->allFilesInPath($data);
                }elseif(is_file($data))
                {
                     include_once $data;
                }
            }
    }
}
