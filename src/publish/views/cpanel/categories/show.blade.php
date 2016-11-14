@extends('layout.index')
@section('title') {{ trans('lang.categories') }}  @endsection
@section('menu') {!! getBreadcrumbs('category',$category->id)->show !!}  @endsection
@section('content')

<div class="note note-info">
    <p>{!! $category->trans('info') !!}</p>
</div>
 
@endsection