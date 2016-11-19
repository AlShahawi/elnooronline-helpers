@extends('layout.index')
@section('title') {{ auth()->user()->name }}  @endsection
@section('menu') {!! getBreadcrumbs('user',auth()->user()->id)->edit !!}  
@endsection
@section('content')
	{!! bsForm::open(['title'=>'user_info','files'=>true]) !!}
		{!! bsForm::text('name',auth()->user()->name) !!}
		{!! bsForm::email('email',auth()->user()->email) !!}
		{!! bsForm::text('phone',auth()->user()->phone) !!}
		{!! bsForm::password('password') !!}
		{!! bsForm::password('password_confirmation') !!}
		{!! bsForm::textarea('info',auth()->user()->info,['class'=>'editor form-control']) !!}
		{!! bsForm::image('image',auth()->user()->img('image')) !!}
	{!! bsForm::close(['submit'=>'save']) !!}
@endsection
