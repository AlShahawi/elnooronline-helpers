@extends('layout.index')
@section('title') {{ trans('lang.contacts') }}  @endsection
@section('menu') {!! getBreadcrumbs('contact')->trashed !!}  @endsection
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
                     <th>{{ trans('lang.email') }}</th>
                     <th>{{ trans('lang.subject') }}</th>
                     <th>{{ trans('lang.ip') }}</th>
                     <th>{{ trans('lang.created_at') }}</th>
                     <th>{{ trans('lang.actions') }}</th>
                </tr>
            </thead>
            <tbody>
            @foreach($contacts as $contact)
            <tr>
                <td class="text-center">{!! bsForm::forceDeleteSelect($contact->id) !!}</td>
                 <td>{{ $contact->name }}</td>
                 <td>{{ $contact->email }}</td>
                 <td>{{ $contact->subject }}</td>
                 <td>{{ $contact->ip }}</td>
                 <td>{{ date('Y/m/d ( h:i:s A)',strtotime($contact->created_at)) }}</td>
                 <td>
                     {!! Btn::viewTrash($contact->id) !!}
                     {!! Btn::forceDelete($contact->id,$contact->name) !!}
                 </td>
            </tr>
            @endforeach
                
            </tbody>
        </table>
    </div>
</div>
<!-- END EXAMPLE TABLE PORTLET-->


@endsection