@extends('layout.index')
@section('title') {{ trans('lang.pages') }}  @endsection
@section('menu') {!! getBreadcrumbs('page')->index !!}  @endsection
@section('content')
<!-- BEGIN EXAMPLE TABLE PORTLET-->
<div class="portlet light bordered">
    <div class="portlet-title">
  {!! Btn::deleteAll() !!}  {!! Btn::create() !!} {!! Btn::trashed() !!} 
    </div>
    <div class="portlet-body">
        <table class="table table-striped table-bordered table-hover datatable" width="100%">
            <thead>
                <tr>
                    <th class="text-center">{!! bsForm::deleteAllSelect() !!}</th>
                     <th>{{ trans('lang.name') }}</th>
                     <th>{{ trans('lang.created_at') }}</th>
                     <th>{{ trans('lang.actions') }}</th>
                </tr>
            </thead>
            <tbody>
            @foreach($pages as $page)
            <tr>
                <td class="text-center">{!! bsForm::deleteSelect($page->id) !!}</td>
                 <td>{{ $page->trans('name') }}</td>
                 <td>{{ date('Y/m/d',strtotime($page->created_at)) }}</td>
                 <td>
                     {!! Btn::view($page->id) !!}
                     {!! Btn::edit($page->id) !!}
                     {!! Btn::delete($page->id,$page->trans('name')) !!}
                 </td>
            </tr>
            @endforeach
                
            </tbody>
        </table>
    </div>
</div>
<!-- END EXAMPLE TABLE PORTLET-->


@endsection