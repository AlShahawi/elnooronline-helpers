@extends('layout.index')
@section('title') {{ trans('lang.pages') }}  @endsection
@section('menu') {!! getBreadcrumbs('page')->trashed !!}  @endsection
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
                     <th>{{ trans('lang.name') }}</th>
                     <th>{{ trans('lang.created_at') }}</th>
                     <th>{{ trans('lang.actions') }}</th>
                </tr>
            </thead>
            <tbody>
            @foreach($pages as $page)
            <tr>
                <td class="text-center">{!! bsForm::forceDeleteSelect($page->id) !!}</td>
                 <td>{{ $page->trans('name') }}</td>
                 <td>{{ date('Y/m/d',strtotime($page->created_at)) }}</td>
                 <td>
                     {!! Btn::viewTrash($page->id) !!}
                     {!! Btn::forceDelete($page->id,$page->trans('name')) !!}
                 </td>
            </tr>
            @endforeach
                
            </tbody>
        </table>
    </div>
</div>
<!-- END EXAMPLE TABLE PORTLET-->


@endsection