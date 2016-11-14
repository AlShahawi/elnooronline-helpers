@extends('layout.index')
@section('title') {{ trans('lang.menus') }}  @endsection
@section('menu') {!! getBreadcrumbs('menu')->index !!}  @endsection
@section('content')
{!! Btn::deleteAll() !!} 
{!! Btn::create() !!} 
{!! Btn::trashed() !!} 
<br>
<br>
<div class="well">
    {!! bsForm::deleteAllSelect() !!} {{ trans('lang.select_all') }}
</div>
<div class="row">
    <div class="col-md-6">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject font-purple sbold uppercase">{{ trans('lang.header') }}</span>
                </div>

            </div>
            <div class="portlet-body">
                <div class="dd1" id="nestable_list_1">
                    {!! \Control::orderHtml('menu','parent',0,'header') !!}    
                </div>
            </div>
        </div>
    </div>


    <div class="col-md-6">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject font-purple sbold uppercase">{{ trans('lang.footer') }}</span>
                </div>

            </div>
            <div class="portlet-body">
                <div class="dd2" id="nestable_list_2">
                    {!! \Control::orderHtml('menu','parent',0,'footer') !!}    
                </div>
            </div>
        </div>
    </div>
</div>





@endsection
@section('js')
    <script>

var updateOutput = function (e) {
        var list = e.length ? e : $(e.target),
            output = list.data('output');
        if (window.JSON) {
            var serialize = window.JSON.stringify(list.nestable('serialize'));
             console.log(typeof serialize);
            $.ajax({
                url: '{{ url(cp.'menus/order') }}',
                type: 'post',
                data: {data:serialize,_token:'{{ csrf_token() }}'},
                success:function(res)
                {
                    // console.log(res);
                }
            });
        }
    };


$(function() {    
   $('#nestable_list_1').nestable({
    group:1,
    maxDepth:2,
    rootClass:'dd1'

   })
    .on('change', updateOutput);

   $('#nestable_list_2').nestable({
    group:1,
    maxDepth:1,
    rootClass:'dd2'
   })
    .on('change', updateOutput);


});


</script>
@stop