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

 <label for="submitForceRestoreAll" 

	@foreach($attr as $key => $value)
	{{ $key }}="{{ $value }}" &nbsp

	@endforeach
 ><i class="fa fa-times fa-fw"></i> {{ trans('lang.Restore_selected') }}</label>

	

@else
	   <label for="submitForceRestoreAll" class="btn btn-success"><i class="fa fa-times fa-fw"></i> {{ trans('lang.restore_selected') }}</label>
    

@endif

{!! Form::submit('',['class'=>'hidden','name'=>'restore','id'=>'submitForceRestoreAll','form'=>'formForceDeleteAll']) !!}

        @endif

@else
		@if(!empty($attr))

 <label for="submitForceRestoreAll" 

	@foreach($attr as $key => $value)
	{{ $key }}="{{ $value }}" &nbsp

	@endforeach
 ><i class="fa fa-reply fa-fw"></i> {{ trans('lang.restore_selected') }}</label>

	

@else
	   <label for="submitForceRestoreAll" class="btn btn-success"><i class="fa fa-reply fa-fw"></i> {{ trans('lang.restore_selected') }}</label>
    

@endif


 {!! Form::submit('restore',['class'=>'hidden','name'=>'restore','id'=>'submitForceRestoreAll','form'=>'formForceDeleteAll']) !!}
@endif









