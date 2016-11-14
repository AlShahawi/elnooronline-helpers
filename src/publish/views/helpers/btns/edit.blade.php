
<?php 

	if (isset($attr['url'])) 
	{
		$action = url($attr['url'].'/'.$id);
	}else{

	$action = action(getController().'@edit',$id);
	}
	$allow_permessions = [];
	if (count($attr) == 0) 
	{
		$attr = ['class'=> 'fa fa-edit fa-fw fa-lg'];
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
        @if (!is_null(getController()) && in_array('edit',$allow_permessions))
	        <a href="{{ $action }}" 

	@foreach($attr as $key => $value)
	{{ $key }}="{{ $value }}" &nbsp

	@endforeach

	title="{{ trans('lang.edit') }}"></a>

        @endif

@else
	<a href="{{ $action }}" 

	@foreach($attr as $key => $value)
	{{ $key }}="{{ $value }}" &nbsp

	@endforeach

	title="{{ trans('lang.edit') }}"></a>
@endif


