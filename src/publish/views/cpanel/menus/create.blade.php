@extends('layout.index')
@section('title') {{ trans('lang.menu_create') }}  @endsection
@section('menu') {!! getBreadcrumbs('menu')->create !!}  @endsection
@section('content')
    {!! bsForm()->start(['route'=>'menus.store','title'=>'menu_info']) !!}

        {!! bsForm()->select('position',[
          'header'=>trans('lang.header'),
          'footer'=>trans('lang.footer'),
        ],null,['placeholder'=>trans('lang.select_position')]) !!}

<div class="well">
	@foreach ($pages as $id => $page)
	  {!! bsForm()->radio('page',$id,null,['label'=>$page]) !!}
	@endforeach
</div>

	{!! bsForm()->end(['submit'=>'save']) !!}
@endsection
