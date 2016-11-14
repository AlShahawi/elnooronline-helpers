<?php 
namespace AhmedFathy\Helpers\Src;
/**
* 
*/
class Sidebar 
{
	protected $controller;

	protected $method = 'index';

	protected $icon ='fa fa-tags';

	protected $title;

	protected $url;

	protected $route;

	protected $render;

	protected $parent;

	protected $children = [];

	public function __construct()
	{
		
	}

	public function render()
	{
		if (empty($this->title)) 
		{
			$controller = class_basename($this->controller); //example : HomeSettingController
			// output : HomeSettingController
			$controller = explode('Controller',$controller)[0]; 
			// output : HomeSetting
			$controller = strtolower(snake_case(str_plural($controller))); 

			$this->title = trans('lang.'.$controller);
		}
		// if (empty($this->url) && !empty($this->controller)) 
		// {
		// 	$this->url = action($this->controller.'@'.$this->method);
		// }
		if (empty($this->render)) 
		{
			$child = new SidebarChildren($this->controller);
			$this->render = view('helpers.sidebar.field',[
				'controller' => $this->controller,
				'icon' => $this->icon,
				'title' => $this->title,
				'url' => $this->url,
				'route' => $this->route,
				'method' => $this->method,
				'parent' => $this->parent,
				])->render();
		}

		$this->controller = '';
		$this->method = 'index';
		$this->icon = 'fa fa-tags';
		$this->title = '';
		$this->url = '';
		$this->parent = '';
		echo $this->render;
	}
	

	public function controller($controller)
	{
		$this->controller = '\App\Http\Controllers\\'.$controller;
		 return $this;
	}
	public function method($method)
	{

		$this->method = $method;

		 return $this;
	}

	public function title($title)
	{
		 $this->title = $title;
		 return $this;
	}

	public function icon($icon)
	{
		 $this->icon = $icon;
		 return $this;
	}


	public function url($url)
	{
		 $this->url = $url;
		 return $this;
	}

	public function route($route)
	{
		 $this->route = $route;
		 return $this;
	}


	public function dropdown(callable $callback )
	{
		$child = new SidebarChildren($this->controller);
		if (empty($this->title)) 
		{
			$controller = class_basename($this->controller); //example : HomeSettingController
			// output : HomeSettingController
			$controller = explode('Controller',$controller)[0]; 
			// output : HomeSetting
			$controller = strtolower(snake_case(str_plural($controller))); 

			$this->title = trans('lang.'.$controller);
		}
		$this->url = '#';
		$data = view('helpers.sidebar.dropdown',[
			'controller' => $this->controller,
			'method' => $this->method,
			'icon' => $this->icon,
			'title' => $this->title,
			'url' => $this->url,
			'route' => $this->route,
			'callback' => $callback,
			'parent' => $this->parent,
			'this' => $child,
			])->render();
		$this->controller = '';
		$this->method = '';
		$this->icon = '';
		$this->title = '';
		$this->url = '';
		$this->parent = '';

		
		return $data;
	}
	



}

class SidebarChildren extends Sidebar
{
	protected $controller;

	protected $method = 'index';

	protected $icon = 'fa fa-tags';

	protected $title;

	protected $url;

	protected $route;

	protected $render;
	
	protected $parent;

	public function __construct($parent)
	{
		$this->parent = $parent;
	}

	public function render()
	{
		$child = new SidebarChildren($this->controller);
		if (empty($this->title)) 
		{
			$controller = class_basename($this->controller); //example : HomeSettingController
			// output : HomeSettingController
			$controller = explode('Controller',$controller)[0]; 
			// output : HomeSetting
			$controller = strtolower(snake_case(str_plural($controller))); 

			$this->title = trans('lang.'.$controller);
		}
		if (empty($this->url) && !empty($this->controller)) 
		{
			$this->url = action($this->controller.'@'.$this->method);
		}
			$this->render = view('helpers.sidebar.field',[
				'controller' => $this->controller,
				'method' => $this->method,
				'icon' => $this->icon,
				'title' => $this->title,
				'url' => $this->url,
				'route' => $this->route,
				'parent' => $this->parent,
				])->render();

		$this->controller = '';
		$this->method = 'index';
		$this->icon = 'fa fa-tags';
		$this->title = '';
		$this->url = '';
		$this->parent = '';
		
		echo $this->render;
		// $this->render = '';
	}
	
	public function controller($controller)
	{

		$this->controller = '\App\Http\Controllers\\'.$controller;
		 return $this;
	}

	public function method($method)
	{

		$this->method = $method;
		 return $this;
	}


	public function title($title)
	{

		 $this->title = $title;
		 return $this;
	}

	public function icon($icon)
	{

		 $this->icon = $icon;
		 return $this;
	}

	public function url($url)
	{

		 $this->url = $url;
		 return $this;
	}

	public function route($route)
	{

		 $this->route = $route;

		 return $this;
	}

	
}
