<?php 

	$allow_permessions = [];

	if(!empty($name))
{
	$name = $name ;
}elseif(empty($name) && empty($options['name']))
{
	$name = trans('lang.thefield');

}elseif(!empty($options['name'])){
	$name =$options['name'];
}
	$options = !empty($options) ? $options :'';

	if (is_numeric($options))
	{
		$url = url()->current().'/'.$options;
	}elseif(is_array($options)){
		$url = isset($options['url']) ? url($options['url']) : url()->current();
	}else{
		$url = url()->current();
	}


?>


@if (auth()->user()->rule != 'admin')
        <?php 
            $allow = auth()->user()->permessions()->where('controller',getController())
                 ->whereHas('methods', function ($query) {
                       $query->where('has_rule', true);
                  })->first();
                 if(!is_null($allow))
                 {
                $allow_permessions = $allow->methods()->where('has_rule', true)->lists('method')->toArray();
                    
                 }
        ?>
        @if (in_array('destroy',$allow_permessions))
	        @if(is_array($options))

<a msg="{{trans('lang.delete_msg',['var'=>$name])}}" url="{{ $url }}" href="javascript:;" title="{{trans('lang.delete')}}" 

	@foreach($options as $key => $value)
		@if ($key != 'url')
			{{ $key }}="{{ $value }}" &nbsp
		@endif
	@endforeach
	class="btn-delete"
>
     <i class="fa fa-trash"></i>
    </a>


@else
	<a msg="{{trans('lang.delete_msg',['var'=>$name])}}" url="{{ $url }}" href="javascript:;" title="{{trans('lang.delete')}}" class="btn-delete">
    <i class="fa fa-trash fa-lg"></i>

    </a>
@endif

        @endif

@else
@if(is_array($options))

<a msg="{{trans('lang.delete_msg',['var'=>$name])}}" url="{{ $url }}" href="javascript:;" title="{{trans('lang.delete')}}" 

	@foreach($options as $key => $value)
		@if ($key != 'url')
			{{ $key }}="{{ $value }}" &nbsp
		@endif
	@endforeach
	class="btn-delete"
>
     <i class="fa fa-trash"></i>
    </a>


@else
	<a msg="{{trans('lang.delete_msg',['var'=>$name])}}" url="{{ $url }}" href="javascript:;" title="{{trans('lang.delete')}}" class="btn-delete">
    <i class="fa fa-trash fa-lg"></i>

    </a>
@endif
@endif

