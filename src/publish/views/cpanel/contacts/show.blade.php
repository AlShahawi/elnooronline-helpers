@extends('layout.index')
@section('title') {{ $contact->name }}  @endsection
@section('menu') {!! getBreadcrumbs('contact',$contact->id)->show !!}  
@endsection

@section('content')
<div class="note note-info">
    <h4 class="block"><b>{{ trans('lang.ip') }} : </b> {{ $contact->ip }}</h4>
    <h4 class="block"><b>{{ trans('lang.email') }} : </b> {{ $contact->email }}</h4>
    <h4 class="block"><b>{{ trans('lang.subject') }} : </b> {{ $contact->subject }}</h4>
    <h4 class="block" style="line-height: 30px">{{ $contact->message }}</h4>
</div>
@endsection