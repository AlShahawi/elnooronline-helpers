<?php 
namespace AhmedFathy\Helpers\Src;
use App\PermessionMethod;
use App\Permession;
use App\User;
use ReflectionClass;
use ReflectionMethod;
trait PermessionTrait {

	public function getMethods($cls) // This Method Used To Return All Methods In Class
        {
            $class = new ReflectionClass($this);
            $methods = (array) $class->getMethods(ReflectionMethod::IS_PUBLIC | ReflectionMethod::IS_PROTECTED | ReflectionMethod::IS_PRIVATE);
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

	public function permession($class)
	{
		$this->middleware('auth');
		if (auth()->check()) 
		{
			# code...
		
		$methods = $this->getMethods($class); // Get All Methods In Controller

	$controller = '\\'.$class; 



		if (!is_null(auth()->user()->permessions)) 
		{
			/* Check If User Has Permession */
			$permession = auth()->user()->permessions()->where('controller',$controller)->first();

			$unauthorize = [];
		# code...
			if (!is_null($permession)) 
			{
				foreach ($permession->methods as $perm) 
				{

					if (!$perm->has_rule && auth()->user()->rule != 'admin') 
					{
						$unauthorize[] = $perm->method;
					}
				}
			}
			$rules = ['admin','editor'];
			if (in_array(auth()->user()->rule,$rules)) 
			{
				$this->middleware('Unauthorized',['only'=>$unauthorize]);
			}else{
				$this->middleware('Unauthorized');
			}
		}
	
	   }

	}
}

 ?>
