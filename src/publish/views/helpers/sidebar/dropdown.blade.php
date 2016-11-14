<?php
if ($url) 
{
	$url = url($url);
}elseif($route)
{
	$url = route($route);
}
if (empty($url)&&empty($route)) {
	$url = url(cp.($controller?$controller:''));
}
 ?>


<li class="nav-item">
    <a href="{{ $url }}" class="nav-link nav-toggle">
        @if ($icon)
        <i class="{{ $icon }}"></i>
        @endif

        @if ($title)
        <span class="title">{{ $title }}</span>
        @else
        <span class="title">{{ trans('lang.'.$controller) }}</span>
        @endif
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        
        {!! call_user_func_array($callback, [$this]) !!}
        
    </ul>
</li>