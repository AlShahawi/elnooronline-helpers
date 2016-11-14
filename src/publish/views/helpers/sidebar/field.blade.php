<?php

$url = action($controller.'@'.$method);

if (!empty($url)) 
{
    $url = url($url);
}elseif(!empty($route))
{
    $url = route($route);
}
$controller_name = class_basename($controller); //example : HomeSettingController
            // output : HomeSettingController
            $controller_name = explode('Controller',$controller_name)[0]; 
            // output : HomeSetting
            $controller_name = strtolower(snake_case(str_plural($controller_name)));
    $allow_permessions = [];
 ?>
@if (auth()->user()->rule != 'admin')
        <?php 
            $allow = auth()->user()->permessions()->where('controller',$controller)
                 ->whereHas('methods', function ($query) {
                       $query->where('has_rule', true);
                  })->first();
                 if(!is_null($allow))
                 {
                $allow_permessions = $allow->methods()->where('has_rule', true)->lists('method')->toArray();
                    
                 }

            
        ?>
        @if (in_array($method,$allow_permessions))
        <li class="nav-item start {{ url()->current() == $url ? 'active open': 
        Request::segment(2) == $controller_name ? 'active open' : '' }}">
            <a href="{{ $url }}" class="nav-link nav-toggle">
                @if ($icon)
                <i class="{{ $icon }}"></i>
                @endif

                @if ($title)
                <span class="title">{{ $title }}</span>
                @else
                <span class="title">{{ trans('lang.'.$controller_name) }}</span>
                @endif
                <span class="selected"></span>
            </a>
        </li>
        @endif

@else
<li class="nav-item start {{ $url == url()->current() ? 'active open':
Request::segment(2) == $controller_name ? 'active open' : '' }}">
    <a href="{{ $url }}" class="nav-link nav-toggle">
        @if ($icon)
        <i class="{{ $icon }}"></i>
        @endif

        @if ($title)
        <span class="title">{{ $title }}</span>
        @else
        <span class="title">{{ trans('lang.'.$controller_name) }}</span>
        @endif
        <span class="selected"></span>
    </a>
</li>
@endif
