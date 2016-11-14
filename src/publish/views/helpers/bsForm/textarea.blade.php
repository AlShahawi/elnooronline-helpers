
<?php
   $attributes = !empty($attributes) ? $attributes : [];
   $name1 = explode('#', $name);
   $hasLabel = isset($attributes['label']) ? $attributes['label'] : trans('lang.'.trim($name1[0],'[]'));
   $hasHolder = isset($attributes['placeholder']) ? $attributes['placeholder'] : trans('lang.'.trim($name1[0],'[]'));
   $name = implode('', $name1);
   $value = !empty($value) ? $value : (is_string(old($name)) ? old($name) : null);
?>

<div class="form-group{{ $errors->has(trim($name,'[]')) ? ' has-error' : '' }}">
@if ($hasLabel)
   <label for="{{ $name }}" class="control-label">{{ $hasLabel }}</label>
@endif
<div class="input-icon right">   
   @if($errors->has(trim($name,'[]')))
   <i class="fa fa-warning tooltips" data-original-title="{{ $errors->first($name) }}"></i>
   @endif
   {!! Form::textarea($name,$value,array_merge([
      'class'=>'form-control',
      'placeholder' => $hasHolder ? $hasHolder : trans('lang.'.trim($name1[0],'[]'))
      ],$attributes)) !!}
   
</div>
</div>
