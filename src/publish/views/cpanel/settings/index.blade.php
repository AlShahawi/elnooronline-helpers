@extends('layout.index')
@section('title') {{ trans('lang.settings') }}  @endsection
@section('menu') {!! breadcrumbs() !!}  @endsection
@section('content')


@include('cpanel.settings.inc.header')

@include('cpanel.settings.lang.index')

@include('cpanel.settings.inc.footer')







@endsection

