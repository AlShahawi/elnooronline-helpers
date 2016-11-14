@extends('layout.index')
@section('title') {{ trans('lang.categories') }}  @endsection
@section('menu') {!! getBreadcrumbs('category')->index !!}  @endsection
@section('content')

{!! Btn::deleteAll() !!} 
{!! Btn::create() !!} 
{!! Btn::trashed() !!} 
<br>
<br>
<div class="row">

    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">

                <div class="caption">
                    <span class="caption-subject font-purple sbold uppercase">
{!! bsForm::deleteAllSelect() !!}
                    {{ trans('lang.categories') }}
                    </span>
                </div>

            </div>
            <div class="portlet-body">
                <div class="dd1" id="nestable_list_1">
                    {!! \Control::orderHtml('category','parent',0) !!}    
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
            $.ajax({
                url: '{{ url(cp.'categories/order') }}',
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
    maxDepth:4,
    rootClass:'dd1'

   })
    .on('change', updateOutput);


});


</script>


@endsection