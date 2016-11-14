@extends('layout.index')
@section('title') {{ trans('lang.categories') }}  @endsection
@section('menu') {!! getBreadcrumbs('category',$category->id)->edit !!}  @endsection
@section('content')

{!! bsForm::start(['route'=>['categories.update',$category->id],'files'=>true,'method'=>'put','title'=>'category_info']) !!}
    
    {!! bsForm::translate(function($form,$lang) use($category){

        $form->text('name',$category->trans('name',$lang));
        $form->textarea('info',$category->trans('info',$lang),['class'=>'editor form-control']);

    }) !!}


 {!! bsForm()->text('icon',$category->icon,['class'=>'icon form-control']) !!}

{!! bsForm::file($category->files->lists('id'),'icon',trans('lang.icon_img')) !!}


    {!! bsForm::end(['submit'=>'save']) !!}

    
@endsection
