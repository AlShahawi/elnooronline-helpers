@extends('layout.index')
@section('title') {{ $page->trans('name') }}  @endsection
@section('menu') {!! getBreadcrumbs('page',$page->id)->show_trashed !!}  @endsection
@section('content')
    @if ($page->out_url == '')
    <div class="note note-info">
        <p> {!! $page->trans('content') !!}</p>
    </div>
@else
<div class="well">
    <a href="{{ $page->out_url }}" target="_blank"> <i class="fa fa-globe"></i> {{ trans('lang.show') }}</a>
</div>
@endif
<!-- //map_ -->
        <div class="cntr">
            <div class="comments-box">
            <h4>{{ trans('lang.comments') }}</h4>
            {!! Control::comments($page,'page') !!}
            </div>
            <!-- //comments-box -->
        </div>

@endsection

@section('js')
	<script>
        $(document).on('submit', '.comment-form', function(event) {
            event.preventDefault();
            var comment = $(this).find('textarea').val(),
                url = $(this).attr('action');
                var el = $(this);
                 var html = '<li>'+
                        '<div class="comment-in">'+
                        '<a href="#"><img src="{{ auth()->user()->img() }}"  class="avatar"></a>'+
                            '<div>'+
                                '<span class="ii">'+
                    '<i class="fa fa-user"></i> '+
                    '<em><a href="javascript:;">{{ auth()->user()->name }}</a></em>'+
                    '<i class="fa fa-clock-o"></i> '+
                    '<em> {{ Time::get(time()) }}</em>'+
                    '</span>'+
                                '<p class="new-comment"><i class="fa fa-spinner fa-pulse fa-fw"></i><span class="sr-only">Loading...</span></p>'+
                            '</div>'+
                        '</div>'+
                    '</li>';
                    if (!$.trim(comment) == '') 
                    {
                    $.ajax({
                        url: url,
                        type: 'post',
                        data: {comment: comment,_token:'{{ csrf_token() }}'},
                        beforeSend:function(){
                            $('.new-comment').removeClass('new-comment');
                            el.closest('li').prev('.result').append(html);  
                            el.find('textarea').val('');  
                        },
                        success:function(res){
                            $('.new-comment').text(res);
                        },
                        error:function(xhr)
                        {
                            // console.log(xhr.responseText);
                            if (xhr.status == 400) {
                             $('.new-comment').html(xhr.responseText);  
                            el.find('textarea').val('');
                            }
                        }

                    });
                        
                    }


        });

    </script>
@stop