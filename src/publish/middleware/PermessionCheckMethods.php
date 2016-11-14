<?php

namespace App\Http\Middleware;

use Closure;

class PermessionCheckMethods
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        foreach (\App\User::where('rule','editor')->get() as $user) 
        {
            foreach ($this->allControllers() as $controller) 
            {
                
                $methods = $this->getMethods($controller); // Get All Methods In Controller

                $controller = '\\'.$controller;

                /* Insert Permession If Not Exist */
                $permession = $user->permessions()->where('controller',$controller);

                if (!$permession->exists()) 
                {
                    $permession = $user->permessions()->create(['controller'=>$controller]);
                }
                else{
                    $permession = $permession->first();
                }

                /* Insert Methods If Not Exist */
                foreach ($methods as $method) 
                {
                    $permession_methods = $permession->methods()->where('method',$method);

                    if (!$permession_methods->exists()) 
                    {
                        $permession->methods()->create(['method'=>$method]);
                    }
                }

                /* Delete Controller If Not Exist */
                foreach (\App\Permession::all() as $perm) 
                {
                    if (!class_exists($perm->controller)) 
                    {
                        $perm->delete();
                    }
                }
                /* Delete Methods If Not Exist In Controller */
                foreach ($permession->methods as $m) 
                {
                    if (!in_array($m->method,$methods)) 
                    {
                        $m->delete();
                    }
                }
            }

        }

        return $next($request);
    }

    public function allControllers()
    {
            $controllers = [];

            foreach (\Route::getRoutes()->getRoutes() as $route)
            {
                $action = $route->getAction();

                if (array_key_exists('controller', $action))
                {
                    $action = explode('@', $action['controller'])[0];
                    if (!str_contains($action, 'Auth')
                        && !str_contains($action, 'Notfication')) 
                    {
                        if (class_exists($action)) 
                        {
                            $controllers[] = $action;
                            # code...
                        }
                    }
                }
            }
            return array_unique($controllers);
    }

    public function getMethods($cls) // This Method Used To Return All Methods In Class
    {
        $class = new \ReflectionClass($cls);
        $methods = (array) $class->getMethods(\ReflectionMethod::IS_PUBLIC | \ReflectionMethod::IS_PROTECTED | \ReflectionMethod::IS_PRIVATE);
        $arry =[];
        $mthod =[];
        foreach ($methods as $key => $value) 
        {
            $arry[$key] = (array) $value;
        }
        foreach ($arry as $val) 
        {
            if ($val['class'] == $cls 
                && $val['name'] != '__construct'
                && $val['name'] != 'maintenance'
                && $val['name'] != 'lang'
                ) 
            {
                
                $mthod[] = $val['name'];
                
            }
        }
        return  $mthod;

    }
}
