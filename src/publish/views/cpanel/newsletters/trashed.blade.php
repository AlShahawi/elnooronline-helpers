@extends('layout.index')
@section('title') {{ trans('lang.newsletters') }}  @endsection
@section('menu') {!! getBreadcrumbs('newsletter')->trashed !!}  @endsection
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
                     <th>{{ trans('lang.email') }}</th>
                     <th>{{ trans('lang.created_at') }}</th>
                     <th>{{ trans('lang.actions') }}</th>
                </tr>
            </thead>
            <tbody>
            @foreach($newsletters as $newsletter)
            <tr>
                <td class="text-center">{!! bsForm::forceDeleteSelect($newsletter->id) !!}</td>
                 <td>{{ $newsletter->email }}</td>
                 <td>{{ date('Y/m/d ( h:i:s A)',strtotime($newsletter->created_at)) }}</td>
                 <td>
                     {!! Btn::forceDelete($newsletter->id,$newsletter->email) !!}
                 </td>
            </tr>
            @endforeach
                
            </tbody>
        </table>
    </div>
</div>
<!-- END EXAMPLE TABLE PORTLET-->


@endsection