var FormDropzone = function () {


    return {
        //main function to initiate the module
        init: function () {  

            Dropzone.options.myDropzone = {
                dictDefaultMessage: "",
                acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg",
                init: function() {
                    this.on("addedfile", function(file) {
                        
                    });
                    this.on("error", function(file, response) {
                        $(file.previewElement).find('.dz-error-message').text(response.file[0]);

                    });
                    this.on("success", function(file, response) {
                      var html = response['view'];
                                  $('.well.active').removeClass('hidden');
                        // Create the remove button
                        var removeButton = Dropzone.createElement("<a href='javascript:;'' class='btn red btn-sm btn-block'>"+response['delete_btn']+"</a>");
                        
                        // Capture the Dropzone instance as closure.
                        var _this = this;

                        // Listen to the click event
                        removeButton.addEventListener("click", function(e) {
                          // Make sure the button click doesn't submit the form:
                          e.preventDefault();
                          e.stopPropagation();
                            
                          // Remove the file preview.
                          _this.removeFile(file);
                          $.ajax({
                            url: response['delete_url'],
                            type: 'post',
                            data: {
                              path: response['path'],
                              _token: response['token'],
                              type: response['type'],
                            },
                            success:function(response)
                            {
                              $('#allfiles').html(response['manager']);

                                
                            }
                          });
                          
                          $('#'+response['id']).remove();
                          
                          // If you want to the delete the file on the server as well,
                          // you can do the AJAX request here.
                        });


                        // Add the button to the file preview element.
                        file.previewElement.appendChild(removeButton);
                          // var type = file.type;
                          // type = type.split('/')[0];
                          // if (type == 'image') 
                          // {
                              $('#allfiles').html(response['manager']);
                          // }
                           var id = response['file_id'], 
                                  url = $('html').attr('url');
                                  var el = $('.file-item[file-id='+id+']');
                                  if (response['request_type'] == 'multiple') 
                                  {
                                    $.get(url+'/file/check/'+id, function(data) {

                                      /*optional stuff to do after success */
                                      $('.well').removeClass('hidden');
                                      if ($('.well').find('div[file-id='+id+']').length == 0) 
                                      {
                                        $('.well').find('.row').append(data);
                                      }else{
                                        $('.well').find('div[file-id='+id+']').remove();
                                        el.css('border','1px solid #337ab7');
                                      }
                                    });
                                    
                                  }else if(response['request_type'] == 'once')
                                  {
                                    $.get(url+'/file/check/'+id, function(data) {
                                      /*optional stuff to do after success */
                                      $('.well').removeClass('hidden');
                                      
                                        $('.well').find('.row').html(data);
                                      
                                    });
                                  }

                    });
                }            
            }

        }
    };
}();

jQuery(document).ready(function() {    
   FormDropzone.init();
   $(document).on('click', '.delete_image', function(event) {
     event.preventDefault();
     var el = $(this);
     $.get(el.attr('href'),function(){
        el.closest('.image-preview-item').remove();
     });
   });


   $(document).on('click', '.uncheck_file', function(event) {
     event.preventDefault();
     var el = $(this);
     el.closest('.image-preview-item').remove();
   });

   $(document).on('click', '.pagination a', function(event) {
      event.preventDefault();
      var el = $(this);
      // 
      var page , href = el.attr('href'),url,type = $(this).closest('.modal').attr('type');
      page = href.split('?f=')[1];
      url = $('html').attr('url');
      $.get(url+'/files/pagination',{f:page,type:type}, function(data) {
        $('#allfiles').html(data);
      });

    });
var check = true;
      $(document).on('click', 'label.thumbnail.multiple', function(event) {

        var el = $(this);
        if (check) 
        {
          // el.css('border','1px solid #337ab7');
          var id = el.find('input[type=radio]').val();
          url = $('html').attr('url');
          $.get(url+'/file/check/'+id, function(data) {
            /*optional stuff to do after success */
            $('.well').removeClass('hidden');
            if ($('.well').find('div[file-id='+id+']').length == 0) 
            {
              $('.well').find('.row').append(data);
            }else{
              $('.well').find('div[file-id='+id+']').remove();
              el.css('border','1px solid #ddd');
            }
          });
          check = false;
        }else{
          $('.well').find('div[file-id='+id+']').remove();
          el.css('border','1px solid #337ab7');
          check = true;
        }

      });

      $(document).on('click', 'label.thumbnail.once', function(event) {
          var id = $(this).find('input[type=radio]').val();
          $('label.thumbnail.once').css('border','1px solid #ddd');
          $(this).css('border','1px solid #337ab7');
          url = $('html').attr('url');
          $.get(url+'/file/check/'+id, function(data) {
            /*optional stuff to do after success */
            $('.well').removeClass('hidden');
            
              $('.well').find('.row').html(data);
            
          });
        
      });


      $(document).on('click', '.files-btn', function(event) {
        event.preventDefault();
        var type = $(this).attr('type');
            $('#modal-files').attr('type',type);
            $('#modal-files').find('label').attr('class','thumbnail '+type);
            $('#modal-files').find('input[name=type]').val(type);
            $('#modal-files').modal();

      });
});