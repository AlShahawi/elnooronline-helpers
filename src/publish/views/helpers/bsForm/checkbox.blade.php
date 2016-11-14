<?php
$value = !is_null($value) ? $value : old($name);
$checked = $checked == $value ? true : false;
?>


<div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">
  <label>
    {!! Form::checkbox($name,$value ,$checked, array_merge($attributes,[
      'class' =>'form-control icheck'])) !!}
    
           {{ trans('lang.'.trim($name,'[]')) }}
  </label>
        @if ($errors->has($name))
            <span class="help-block">{{ $errors->first($name) }}</span>
        @endif
</div>