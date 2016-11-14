@extends('layout.index')
@section('title') {{ trans('lang.users') }}  @endsection
@section('menu') {!! getBreadcrumbs('user')->index !!}  @endsection
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
                     <th>{{ trans('lang.email') }}</th>
                     <th>{{ trans('lang.phone') }}</th>
                     <th>{{ trans('lang.gender') }}</th>
                     <th>{{ trans('lang.rule') }}</th>
                     <th>{{ trans('lang.created_at') }}</th>
                     <th>{{ trans('lang.actions') }}</th>
                </tr>
            </thead>
            <tbody>
            @foreach($admins as $user)
            <?php
            switch ($user->rule) 
            {
                case 'admin':
                    $label = 'bg-dark bg-font-dark';
                    break;
                case 'editor':
                    $label = 'bg-green-jungle bg-font-green-jungle';
                    break;
                case 'user':
                    $label = 'bg-blue-soft bg-font-blue-soft';
                    break;
                default:
                    $label = 'bg-blue-soft bg-font-blue-soft';
            }
            ?>
            
            <tr style="{{ $user->rule == 'admin' ? 'background: #eef1f5;':'' }}">
                <td class="text-center">{!! bsForm::deleteSelect($user->id) !!}</td>
                 <td>
                     @if ($user->rule == 'admin')
                     <i class="fa fa-star fa-fw font-yellow-gold"></i>
                 @else
                     <i class="fa fa-fw"></i>
                 @endif
                 <a href="{{ url(cp.'users/'.$user->id) }}">
                        <img src="{{ $user->img('sm') }}" width="40">
                        {{ $user->name }}
                 </a>
                 </td>
                 <td>{{ $user->email }}</td>
                 <td>{{ $user->phone }}</td>
                 <td>{{ trans('lang.'.$user->gender) }}</div></td>
                 <td><div class="label {{ $label }}">{{ trans('lang.'.ucfirst($user->rule)) }}</div></td>
                 <td>{{ date('Y/m/d',strtotime($user->created_at)) }}</td>
                 <td>
                     {!! Btn::view($user->id) !!}
                     {!! Btn::edit($user->id) !!}
                     {!! Btn::delete($user->id,$user->name) !!}
                 </td>
            </tr>
            @endforeach

            @foreach($users as $user)
            <?php
            switch ($user->rule) 
            {
                case 'admin':
                    $label = 'bg-dark bg-font-dark';
                    break;
                case 'editor':
                    $label = 'bg-green-jungle bg-font-green-jungle';
                    break;
                case 'user':
                    $label = 'bg-blue-soft bg-font-blue-soft';
                    break;
                default:
                    $label = 'bg-blue-soft bg-font-blue-soft';
            }
            ?>

            <tr style="{{ $user->rule == 'admin' ? 'background: #eef1f5;':'' }}">
                <td class="text-center">{!! bsForm::deleteSelect($user->id) !!}</td>
                 <td>
                     @if ($user->rule == 'admin')
                     <i class="fa fa-star fa-fw font-yellow-gold"></i>
                 @else
                     <i class="fa fa-fw"></i>
                 @endif
                 <a href="{{ url(cp.'users/'.$user->id) }}">
                 <img src="{{ $user->img() }}" width="40">
                 {{ $user->name }}
                 </a></td>
                 <td>{{ $user->email }}</td>
                 <td>{{ $user->phone }}</td>
                 <td>{{ trans('lang.'.$user->gender) }}</div></td>
                 <td><div class="label {{ $label }}">{{ trans('lang.'.ucfirst($user->rule)) }}</div></td>
                 <td>{{ date('Y/m/d',strtotime($user->created_at)) }}</td>
                 <td>
                     {!! Btn::view($user->id) !!}
                     {!! Btn::edit($user->id) !!}
                     {!! Btn::delete($user->id,$user->name) !!}
                 </td>
            </tr>
            @endforeach
                
            </tbody>
        </table>
    </div>
</div>
<!-- END EXAMPLE TABLE PORTLET-->

@endsection
