<?php 

	$action = action(getController().'@create');

	$allow_permessions = [];
	if (count($attr) == 0) 
	{
		$attr = ['class'=> 'btn btn-primary'];
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
        @if (!is_null(getController()) && in_array('create',$allow_permessions))
	        <a href="{{ $action }}" 

			@foreach($attr as $key => $value)
			{{ $key }}="{{ $value }}" &nbsp

			@endforeach

			>
			<i class="fa fa-plus fa-fw "></i> 
			{{ trans('lang.create') }}</a>

        @endif

@else
<a href="{{ $action }}" 

			@foreach($attr as $key => $value)
			{{ $key }}="{{ $value }}" &nbsp

			@endforeach

			>
			<i class="fa fa-plus fa-fw "></i> 
			{{ trans('lang.create') }}</a>
@endif

