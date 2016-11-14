@extends('layout.index')
@section('title') {{ $user->name }}  @endsection
@section('menu') {!! getBreadcrumbs('user',$user->id)->show_trashed !!}  
@endsection

@section('content')

                    <!-- END PAGE HEADER-->
                    <div class="profile">
                        <div class="tabbable-line tabbable-full-width">
    
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1_1">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <ul class="list-unstyled profile-nav">
                                                <li>
                                                    <img src="{{ $user->img('profile') }}" class="img-responsive pic-bordered" alt="" />
                                                </li>
                                                
                                            </ul>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col-md-8 profile-info">
                                                    <h1 class="font-green sbold uppercase">{{ $user->name }}</h1>
                                                    <p> {!! $user->info !!}</p>
 
                                                    <ul class="list-inline">

                                                        <li>
                                                            <i class="fa fa-phone"></i> {{ $user->phone }} </li>
                                                        <li>
                                                            <i class="fa fa-envelope"></i> {{ $user->email }}</li>
                                                        <li>
                                                            <i class="fa fa-user"></i> {{ trans('lang.'.ucfirst($user->rule)) }}</li>
                                                    </ul>
                                                </div>
                                                <!--end col-md-8-->
                                             
                                            </div>
                                            <!--end row-->
                                        
                                        </div>
                                        <div class="col-md-12">
@if($user->rule != 'admin')

        {!! bsForm::open(['route'=>['users.permession_update',$user->id],'title'=>'permessions']) !!}

<div class="row">

@foreach ($user->permessions as $permession)
<?php
 $controller = class_basename($permession->controller); //example : HomeSettingController
// output : HomeSettingController
$controller = explode('Controller',$controller)[0]; 
// output : HomeSetting
$controller = strtolower(snake_case(str_plural($controller))); 

 ?>
        <div class="col-md-4">
            <ul>
                <li><p class="lead">
                <label>
                <input type="checkbox" class="perm-check-all"> <b>{{ trans('lang.'.$controller) }}</b>   
                </label>
                
                </p>
                    <ul>
                        @foreach ($permession->methods as $method)
                        <li>
                            <label>
                            <input type="checkbox" class="checkbox" {{ $method->has_rule ? 'checked' : '' }}
                            name="{{ $permession->controller.'_'.$method->method }}" value="1"> {{ trans('permession.'.$method->method) }}   
                            </label>
                        </li>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div>
@endforeach
            
</div>

    {!! bsForm::close(['submit'=>'save']) !!}

@endif
</div>
                                    </div>
                                </div>
                                <!--tab_1_2-->




                            </div>
                        </div>
                    </div>


@endsection
