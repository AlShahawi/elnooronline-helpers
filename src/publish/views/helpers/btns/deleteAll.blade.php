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
		$url = isset($options['url']) ? $options['url'] : url()->current();
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
		@if(!empty($attr))

 <label for="submitDeleteAll" 

	@foreach($attr as $key => $value)
	{{ $key }}="{{ $value }}" &nbsp

	@endforeach
 ><i class="fa fa-times fa-fw"></i> {{ trans('lang.delete_selected') }}</label>

	

@else
	   <label for="submitDeleteAll" class="btn btn-danger"><i class="fa fa-times fa-fw"></i> {{ trans('lang.delete_selected') }}</label>
    

@endif

{!! Form::open(['method'=>'delete','id'=>'formDeleteAll','class'=>'hidden']) !!}
    {!! Form::submit('',['class'=>'hidden','id'=>'submitDeleteAll']) !!}
    {!! Form::close() !!}

        @endif

@else
		@if(!empty($attr))

 <label for="submitDeleteAll" 

	@foreach($attr as $key => $value)
	{{ $key }}="{{ $value }}" &nbsp

	@endforeach
 ><i class="fa fa-times fa-fw"></i> {{ trans('lang.delete_selected') }}</label>

	

@else
	   <label for="submitDeleteAll" class="btn btn-danger"><i class="fa fa-times fa-fw"></i> {{ trans('lang.delete_selected') }}</label>
    

@endif

{!! Form::open(['method'=>'delete','id'=>'formDeleteAll','class'=>'hidden']) !!}
    {!! Form::submit('',['class'=>'hidden','id'=>'submitDeleteAll']) !!}
    {!! Form::close() !!}
@endif









