@extends('layout.index')
@section('title') {{ $user->name }}  @endsection
@section('menu') {!! getBreadcrumbs('user',$user->id)->edit !!}  @endsection
@section('content')
{!! bsForm()->start(['method'=>'put','url'=>cp.'users/'.$user->id,'files'=>'true','title'=>'user_info']) !!}
		{!! bsForm()->text('name',$user->name) !!}
		{!! bsForm()->email('email',$user->email) !!}
		{!! bsForm()->text('phone',$user->phone) !!}
		{!! bsForm()->password('password') !!}
		{!! bsForm()->password('password_confirmation') !!}
		{!! bsForm()->radio('gender','male',$user->gender) !!}
		{!! bsForm()->radio('gender','female',$user->gender) !!}
		{!! bsForm()->select('rule',[
			'user' => trans('lang.User'),
			'editor' => trans('lang.Editor'),
			'admin' => trans('lang.Admin'),
		],$user->rule) !!}
		{!! bsForm()->textarea('info',$user->info,['class'=>'editor form-control']) !!}

		{!! bsForm()->file($user->files->lists('id'),'profile',trans('lang.profile_image')) !!}
	{!! bsForm()->close(['submit'=>'save']) !!}
@endsection
