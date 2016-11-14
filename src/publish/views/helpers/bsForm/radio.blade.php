<?php
$value = !is_null($value) ? $value : old($name);
$checked = $checked == $value ? true : false;
$attr = isset($attributes['label'])  ? $attributes['label'] : trans('lang.'.$name.'_'.$value);
$group = isset($attributes['group'])  ? $attributes['group'] : true;
?>

@if ($group)
	<div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">
@endif
		  <label>
		    {!! Form::radio($name,$value ,$checked, array_merge($attributes,[
		      'class' =>'form-control icheck'])) !!}
		    
		           {!! $attr !!} 
		  </label>
	        @if ($errors->has($name))
	            <span class="help-block">{{ $errors->first($name) }}</span>
	        @endif
	        &nbsp;&nbsp;
@if ($group)
	</div>
@endif