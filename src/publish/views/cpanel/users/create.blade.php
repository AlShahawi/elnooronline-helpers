@extends('layout.index')
@section('title') {{ trans('lang.user_create') }}  @endsection
@section('menu') {!! getBreadcrumbs('user')->create !!}  @endsection
@section('content')
	{!! bsForm()->open(['route'=>'users.store','files'=>true,'title'=>'user_info']) !!}
		{!! bsForm()->text('name') !!}
		{!! bsForm()->email('email') !!}
		{!! bsForm()->text('phone') !!}
		{!! bsForm()->password('password') !!}
		{!! bsForm()->password('password_confirmation') !!}
		{!! bsForm()->radio('gender','male') !!}
		{!! bsForm()->radio('gender','female') !!}

		{!! bsForm()->select('rule',[
			'user' => trans('lang.User'),
			'editor' => trans('lang.Editor'),
			'admin' => trans('lang.Admin'),
		]) !!}


		{!! bsForm()->textarea('info',null,['class'=>'editor form-control']) !!}

		{!! bsForm()->file([],'profile',trans('lang.profile_image')) !!}
	{!! bsForm()->close(['submit'=>'save']) !!}

@endsection
