$(document).ready(function(){
  $('#closeMediaModal').on('click', function(){
    $('#addImageModal').modal('hide');
    uploader[0].dropzone.removeAllFiles();
    location.reload();
  });

  $('.addMediaModalBtn').on('click', function(){
    var type = $(this).attr("php-type");

    switch (type) {
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

  $('#submitText').on('click', function(){
    var text = $('#addTextInput').val();

    $.post('includes/actions/addtext.php', {text: text}, function(data){
      if (data == "success") {
        $('#addTextModal').modal('hide');
        location.reload();
      } else {
        alert('Sorry, probeer het later opnieuw!');
      }
    })
  });

  $('.deleteMediaBtn').on('click', function(){
    var id = $(this).attr('php-media-id');
    $('.deleteMediaBtnConfirm').attr('php-media-id', id);
    $('#deleteMediaModal').modal('show');
  });

  $('.deleteMediaBtnConfirm').on('click', function(){
    var id = $(this).attr('php-media-id');
    $.post('../includes/actions/deletemedia.php', {id: id}, function(data){
      if (data == "success") {
        $('#deleteMediaModal').modal('hide');
        $('#media').load('includes/generators/medialist.php');
        location.reload();
      } else {
        alert('Fout bij het verwijderen, probeer het later opnieuw!');
      }
    });
  });

  $('.renameMediaBtn').on('click', function(){
    var id = $(this).attr('php-media-id');
    $.post('../includes/generators/renamemediamodal.php', {id: id}, function(data){
      $('#renameMediaModalBody').html(data);
      $('#renameMediaModal').modal('show');
    });
  });

  $('#submitNewMediaName').on('click', function(){
    var newname = $('#newMediaName').val()+$('#newMediaNameExt').html();
    var id = $('#newMediaName').attr('php-media-id');
    $.post('../includes/actions/renamemedia.php', {id: id, newname: newname}, function(data){
      if (data == "success") {
        $('#renameMediaModal').modal('hide');
        location.reload();
      } else {
        alert('Sorry, probeer het later opnieuw');
      }
    });
  });

  $('.text-view').on('click', function(){
    var value = $(this).find('p').html();
    $('#textViewModalBody').html(value);
    $('#textViewModal').modal('show');
  });
});
