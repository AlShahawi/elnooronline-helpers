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
		@php  $id = isset($id) ? $id : '';  @endphp
<input type="checkbox" form="formForceDeleteAll" class="checkbox" value="{{ $id }}" name="delete_or_restore[]">
        @endif

@else
@php  $id = isset($id) ? $id : '';  @endphp
<input type="checkbox" form="formForceDeleteAll" class="checkbox" value="{{ $id }}" name="delete_or_restore[]">
@endif










