@extends('layout.index')
@section('title') {{ trans('lang.page_create') }}  @endsection
@section('menu') {!! getBreadcrumbs('page')->create !!}  @endsection
@section('content')
	{!! bsForm()->open(['route'=>'pages.store','title'=>'page_info']) !!}

{!! bsForm()->translate(function($form){
	$form->text('name');
	$form->textarea('content',null,['class'=>'editor form-control']);
	}) !!}

	<small>{{ trans('lang.urlname_helper') }}</small></h4>
		{!! bsForm()->text('urlname') !!} 
		<div class="alert url-name-preview">
			{{ url('pages/') }}/<b></b>
		</div>
		{!! bsForm()->text('keywords') !!}
		<div class="well">
			<h4>{{ trans('lang.out_url') }} (<b>{{ trans('lang.optional') }}</b>)
			<small>{{ trans('lang.out_url_helper') }}</small></h4>
			{!! bsForm()->url('out_url') !!}
		</div>
<div class="form-group{{ $errors->has('active') ? ' has-error' : '' }}">
    <div class="input-group">
        <div class="icheck-inline">
            <label>
                <input type="checkbox"  checked  name="active" value="1" class="icheck" data-checkbox="icheckbox_square-grey"> {{ trans('lang.active') }} 
            </label>            
        </div>
    </div>
</div>

	{!! bsForm()->close(['submit'=>'save']) !!}
@endsection
