<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
if (trait_exists('Illuminate\Foundation\Validation\HelperValidatesRequests')) 
{
    trait CallValidatesRequests 
    {
        use \Illuminate\Foundation\Validation\HelperValidatesRequests;
        use \AhmedFathy\Helpers\Src\PermessionTrait;
    }
}else{
    trait CallValidatesRequests{
    	use ValidatesRequests;
    }
}

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, CallValidatesRequests;
}

