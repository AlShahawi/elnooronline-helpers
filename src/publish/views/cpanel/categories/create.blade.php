@extends('layout.index')
@section('title') {{ trans('lang.categories') }}  @endsection
@section('menu') {!! getBreadcrumbs('category')->create !!}  @endsection
@section('content')
{!! bsForm::start(['route'=>'categories.store','files'=>true,'title'=>'category_info']) !!}
    {!! bsForm::translate(function($form){

        $form->text('name');
        $form->textarea('info',null,['class'=>'editor form-control']);

    }) !!}

    {!! bsForm()->text('icon',null,['class'=>'icon form-control']) !!}

{!! bsForm::file() !!}


{!! bsForm::end(['submit'=>'save']) !!}
    
@endsection
