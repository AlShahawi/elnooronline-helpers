@extends('layout.index')
@section('title') {{ trans('lang.categories') }}  @endsection
@section('menu') {!! getBreadcrumbs('category')->trashed !!}  @endsection
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
                     <th style="width: 80px;">{{ trans('lang.image') }}</th>
                     <th>{{ trans('lang.name') }}</th>
                     <th>{{ trans('lang.created_at') }}</th>
                     <th>{{ trans('lang.actions') }}</th>
                </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
            <tr>
                <td class="text-center">{!! bsForm::forceDeleteSelect($category->id) !!}</td>
                 <td><img src="{{ $category->img() }}" width="80"></td>
                 <td><a href="{{ root(cp,'categories/get/trashed/',$category->id) }}">{{ $category->trans('name') }}</a></td>
                 <td>{{ date('Y/m/d',strtotime($category->created_at)) }}</td>
                 <td>
                     {!! Btn::viewTrash($category->id) !!}
                     {!! Btn::forceDelete($category->id,$category->trans('name')) !!}
                 </td>
            </tr>
            @endforeach
                
            </tbody>
        </table>
    </div>
</div>
<!-- END EXAMPLE TABLE PORTLET-->


@endsection