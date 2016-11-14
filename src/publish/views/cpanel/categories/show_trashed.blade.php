@extends('layout.index')
@section('title') {{ $category->trans('name') }}  @endsection
@section('menu') 
{!! getBreadcrumbs('category',$category->id)->show_trashed !!}  
@endsection
@section('content')

<div class="note note-info">
    <p>{!! $category->trans('info') !!}</p>
</div>
 
@endsection