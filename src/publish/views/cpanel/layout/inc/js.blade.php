

        {!! Html::script('https://js.pusher.com/3.2/pusher.min.js') !!}
        {!! Html::script($cpanel.'js/script.js') !!}
        {!! Html::script($cpanel.'js/jquery.form.min.js') !!}
        {!! Html::script($cpanel.'js/datatables/datatables.min.js') !!}
        {!! Html::script($cpanel.'js/datatables/plugins/bootstrap/datatables.bootstrap.js') !!}
        {!! Html::script($cpanel.'dropzone/dropzone.min.js') !!}
        {!! Html::script($cpanel.'dropzone/form-dropzone.js') !!}
        {!! Html::script($cpanel.'js/bootstrap-colorpicker.min.js') !!}
        {!! Html::script($cpanel.'js/pusher.js') !!}
        {!! Html::script($cpanel.'js/fontawesome-iconpicker.min.js') !!}
        {!! Html::script($cpanel.'bootstrap-select/js/bootstrap-select.min.js') !!}

@unless (Request::segment(2) == 'settings')
        {!! Html::script(url('vendor/elnooronline/helpers/ckeditor/ckeditor.js')) !!}
        {!! Html::script(url('vendor/elnooronline/helpers/ckeditor/ckeditor.js')) !!}
        <script type="text/javascript">
$('.editor').each(function(i){
    $(this).attr('id','textareaEditor'+i);

        var editor = CKEDITOR.replace( 'textareaEditor'+i , {

        filebrowserBrowseUrl : '{{ url('vendor/elnooronline/helpers') }}/ckfinder/ckfinder.html',
        filebrowserImageBrowseUrl : '{{ url('vendor/elnooronline/helpers') }}/ckfinder/ckfinder.html?type=Images',
        filebrowserFlashBrowseUrl : '{{ url('vendor/elnooronline/helpers') }}/ckfinder/ckfinder.html?type=Flash',
        filebrowserUploadUrl : '{{ url('vendor/elnooronline/helpers') }}/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl : '{{ url('vendor/elnooronline/helpers') }}/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
        filebrowserFlashUploadUrl : '{{ url('vendor/elnooronline/helpers') }}/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',

    });
CKEDITOR.config.language = '{{ app()->getLocale() }}';


});

</script>
@endunless
       
        <script type="text/javascript">
            $(function(){$('input[name="keywords"][type="text"],textarea[name="keywords]').tagsInput({
                width:'auto',
                defaultText:'',
            });});
            $(function(){$('.keywords').tagsInput({
                width:'auto',
                defaultText:'',
            });});
        </script>
        @if (Request::segment(2) != 'settings')
        @include('cpanel.layout.inc.js.datatable')
        @include('cpanel.layout.inc.js.my_script')
        @endif
        @if (config('notfication.live'))
            <script>
                $(function(){liveNotfication();});
            </script>
        @endif
        <script>
            $(document).on('click', '.read_all', function(event) {
                event.preventDefault();
                event.stopPropagation();
                var el = $(this);
                $.ajax({
                    url: cp_url+'/notfications/read_all',
                    data: {_token: token},
  
                    success:function(res)
                    {
                        $('.notfication-ul').html(res);
                    }
                });
                
            });
            $(function(){
            $('.color').colorpicker();
            $('.icon').iconpicker();
        });

      
            
        </script>


        <!-- END THEME LAYOUT SCRIPTS -->
        <!-- Go to www.addthis.com/dashboard to customize your tools -->
<!-- <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-57309cec81749efc"></script> -->

    </body>

</html>
