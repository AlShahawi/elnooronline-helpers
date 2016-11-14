@extends('layout.index')
@section('title') {{ trans('lang.menu_edit') }}  @endsection
@section('menu') {!! getBreadcrumbs('menu',$menu->page->id)->edit !!}  @endsection
@section('content')
    {!! bsForm::start(['method'=>'put','url'=>cp.'menus/'.$menu->id,'files'=>'true','title'=>'menu_info']) !!}

        {!! bsForm::select('position',[
          'header'=>trans('lang.header'),
          'footer'=>trans('lang.footer'),
        ],$menu->position,['placeholder'=>trans('lang.select_position')]) !!}


<div class="well">
@forelse ($pages as $id => $page)
  {!! bsForm::radio('page',$id ,$menu->page_id,['label'=>$page]) !!}
@empty
	{{-- empty expr --}}
@endforelse
</div>

    {!! bsForm::end(['submit'=>'save']) !!}
@endsection
