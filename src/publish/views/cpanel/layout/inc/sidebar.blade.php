                  
{!! sidebar()->controller('Admin\HomeController')
    ->route('cpanel.home')->icon('icon-home')->title(trans('lang.home'))->render() !!}             


{!! sidebar()->title(trans('lang.settings'))->dropdown(function($sidebar){

  $sidebar->controller('Settings\MainController')->title(trans('lang.settings'))->method('index')->render();

  
}) !!}

{!! sidebar()->controller('Admin\UserController')->icon('fa fa-users')->render() !!}

{!! sidebar()->controller('Admin\PageController')->render() !!}

{!! sidebar()->controller('Admin\MenuController')->icon('fa fa-list')->render() !!}

{!! sidebar()->title(trans('lang.categories'))->dropdown(function($sidebar){

	$sidebar->controller('Admin\CategoryController')->render();

}) !!}


{!! sidebar()->controller('Admin\ContactController')->icon('fa fa-phone')->render() !!}

{!! sidebar()->controller('Admin\NewsletterController')->icon('fa fa-rss')->render() !!}

