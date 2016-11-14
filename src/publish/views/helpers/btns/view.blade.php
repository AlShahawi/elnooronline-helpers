
<?php 
	if (isset($attr['url'])) 
	{
		$action = url($attr['url'].'/'.$id);
	}else{

	$action = action(getController().'@show',$id);
	}

	$allow_permessions = [];
	if (count($attr) == 0) 
	{
		$attr = ['class'=> 'fa fa-eye fa-lg'];
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
        @if (in_array('show',$allow_permessions))
	        <a href="{{ $action }}" 

	@foreach($attr as $key => $value)
	{{ $key }}="{{ $value }}" &nbsp

	@endforeach

	title="{{ trans('lang.view') }}"></a>

        @endif

@else
	<a href="{{ $action }}" 

	@foreach($attr as $key => $value)
	{{ $key }}="{{ $value }}" &nbsp

	@endforeach

	title="{{ trans('lang.view') }}"></a>
@endif



