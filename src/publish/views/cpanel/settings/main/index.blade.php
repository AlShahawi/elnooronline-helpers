@extends('layout.index')
@section('title') {{ trans('lang.settings') }}  @endsection
@section('menu') {!! breadcrumbs('main_settings') !!}  @endsection
@section('content')


@include('cpanel.settings.inc.header')

	{!! Form::open(['id'=>'main_settings_form','files'=>true]) !!}
<!-- BEGIN Portlet PORTLET-->
                            <div class="portlet light">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-settings"></i>
                                        <span class="caption-subject bold uppercase"> {{ trans('lang.main_settings') }}</span>
                                    </div>
                                    <div class="actions">
                                    <button type="submit" form="main_settings_form" class="btn btn-circle btn-default">
                                            <i class="fa fa-save"></i> {{ trans('lang.save') }}
                                    </button>
                                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;"> </a>
                                    </div>
                                </div>
<div class="portlet-body">
{!! bsForm::translate(function($form,$lang){
	$form->text('site_name',site('site_name',$lang));
	$form->textarea('site_desc',site('site_desc',$lang));
	}) !!}


<div class="well">
	<div class="row">
		<div class="col-md-6">
        	{!! bsForm::text('mail',site('mail')) !!}
		</div>

		<div class="col-md-6">
        	{!! bsForm::text('phone',site('phone')) !!}
		</div>
		<div class="col-md-6">
		<div class="form-group">
			<label for="maintenance">{{ trans('lang.maintenance') }}</label>
			
			{!! bsForm()->radio('maintenance','open',site('maintenance')) !!}
			{!! bsForm()->radio('maintenance','close',site('maintenance')) !!}
		</div>
		</div>
		<div class="col-md-6">
		<div class="form-group">
			
			{!! bsForm()->checkbox('send_newsletter',1,site('send_newsletter')) !!}
		</div>
		</div>
	</div>
	<div class="row">
	    <div class="col-md-6">
			{!! bsForm::text('facebook',site('facebook')) !!}
		</div>
	    <div class="col-md-6">
			{!! bsForm::text('twitter',site('twitter')) !!}
		</div>
	    <div class="col-md-6">
			{!! bsForm::text('linkedin',site('linkedin')) !!}
		</div>
	    <div class="col-md-6">
			{!! bsForm::text('googleplus',site('googleplus')) !!}
		</div>


		<div class="col-md-12">
			{!! bsForm::text('keywords',site('keywords')) !!}
		</div>

	
		
	</div>
	<div class="row">
	<div class="col-md-6">
		<br>
		<label for="logo">{{ trans('lang.logo') }}</label>
		<br>
		{!! bsForm::image('logo',$logo) !!}
	</div>

	<div class="col-md-6">
		<br>
		<label for="icon">{{ trans('lang.icon') }}</label>
		<br>
		{!! bsForm::image('icon',$icon) !!}
	</div>

</div>
			<div class="form-group">
			<br>
				<button class="btn btn-primary">
                    <i class="fa fa-save"></i> {{ trans('lang.save') }}
				</button>
			</div>
</div>

                                    
                                </div>
                            </div>
                            <!-- END Portlet PORTLET-->

	{!! Form::close() !!}





                                <div class="portlet-body">
                                    <div class="scroller" style="height:200px" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">
                                        
                                    </div>
                                </div>
 @include('cpanel.settings.inc.footer')         
@endsection
