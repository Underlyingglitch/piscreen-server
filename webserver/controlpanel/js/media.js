$(document).ready(function(){
  $('#add-media-btn').on('click', function(){
    $('#addMediaModal').modal('show');
  });

  $('#submitMediaType').on('click', function(){
    var type = $('#mediaTypeSelect').val();

    switch (type) {
      case "--":
        alert('Kies een mediasoort');
        break;
      case "text":
        $('#addMediaModal').modal('hide');
        $('#addTextModal').modal('show');
        break;
      case "image":
        $('#addMediaModal').modal('hide');
        $('#addImageModal').modal('show');
        break;
      case "url":
        $('#addMediaModal').modal('hide');
        $('#addUrlModal').modal('show');
        break;
    }
  });

  $('#fileUpload').submit(function(event){
    if($('#uploadFile').val()) {
      event.preventDefault();
      $('#fileUpload').ajaxSubmit({
        beforeSubmit:function(){
          $('.progress-bar').width('0%');
        },
        uploadProgress:function(event, position, total, percentageComplete){
          $('.progress-bar').animate({
            width: percentageComplete + '%'
          }, {
            duration: 100
          });
        },
        success:function(data){
          alert("Successfully uploaded file!"+data);
        },
        resetForm: true
      });
    }
    return false;
  });
});
