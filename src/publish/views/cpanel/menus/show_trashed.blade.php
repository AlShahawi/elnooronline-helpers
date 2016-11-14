@extends('layout.index')
@section('title') {{ $menu->name }}  @endsection
@section('menu') {!! getBreadcrumbs('menu',$menu->page->id)->show_trashed !!} 
@endsection

@section('content')
<div class="note note-info">
    <p> {!! $menu->page->trans('content') !!}</p>
</div>
@endsection