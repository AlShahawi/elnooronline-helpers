@extends('layout.index')
@section('title') {{ trans('lang.menus') }}  @endsection
@section('menu') {!! getBreadcrumbs('menu')->trashed !!}  @endsection
@section('content')
<!-- BEGIN EXAMPLE TABLE PORTLET-->
<div class="portlet light bordered">
    <div class="portlet-title">
  {!! Btn::forceDeleteAll() !!} {!! Btn::restoreAll() !!}
    </div>
    <div class="portlet-body">
        <table class="table table-striped table-bordered table-hover datatable" width="100%">
            <thead>
                <tr>
                    <th class="text-center">{!! bsForm::forceDeleteAllSelect() !!}</th>
                     <th>{{ trans('lang.page') }}</th>
                     <th>{{ trans('lang.created_at') }}</th>
                     <th>{{ trans('lang.actions') }}</th>
                </tr>
            </thead>
            <tbody>
            @foreach($menus as $menu)
            <tr>
                <td class="text-center">{!! bsForm::forceDeleteSelect($menu->id) !!}</td>
                 <td><a href="{{ root(cp,'menus',$menu->id) }}">{{ $menu->page->trans('name') }}</a></td>
                 <td>{{ date('Y/m/d',strtotime($menu->created_at)) }}</td>
                 <td>
                     {!! Btn::viewTrash($menu->id) !!}
                     {!! Btn::forceDelete($menu->id,$menu->page->trans('name')) !!}
                 </td>
            </tr>
            @endforeach
                
            </tbody>
        </table>
    </div>
</div>
<!-- END EXAMPLE TABLE PORTLET-->


@endsection