@extends('layout.index')
@section('title') {{ trans('lang.page_edit') }}  @endsection
@section('menu') {!! getBreadcrumbs('page',$page->id)->edit !!}  @endsection
@section('content')
	{!! bsForm::start(['method'=>'put','url'=>cp.'pages/'.$page->id,'title'=>'page_info']) !!}

{!! bsForm::translate(function($form,$lang) use($page){
		$form->text('name',$page->trans('name',$lang));
		$form->textarea('content',$page->trans('content',$lang),['class'=>'editor form-control']);
	}) !!}



	<h4>{{ trans('lang.urlname') }} (<b>{{ trans('lang.optional') }}</b>)
	<small>{{ trans('lang.urlname_helper') }}</small></h4>
		{!! bsForm::text('urlname',$page->urlname) !!} 
		<div class="alert  url-name-preview">
			{{ url('pages/') }}/<b>{{ str_slug(strtolower($page->urlname)) }}</b>
		</div>
		{!! bsForm::text('keywords',$page->keywords) !!}
		<div class="well">
			<h4>{{ trans('lang.out_url') }} (<b>{{ trans('lang.optional') }}</b>)
			<small>{{ trans('lang.out_url_helper') }}</small></h4>
			{!! bsForm::url('out_url',$page->out_url) !!}
		</div>
<div class="form-group{{ $errors->has('active') ? ' has-error' : '' }}">
    <div class="input-group">
        <div class="icheck-inline">
            <label>
                <input type="checkbox"  {{ $page->active == 1 ? 'checked' : '' }}  name="active" value="1" class="icheck" data-checkbox="icheckbox_square-grey"> {{ trans('lang.active') }} 
            </label>            
        </div>
    </div>
</div>

	{!! bsForm::end(['submit'=>'save']) !!}
@endsection
