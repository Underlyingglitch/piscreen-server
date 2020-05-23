$(document).ready(function(){
  $('#closeMediaModal').on('click', function(){
    $('#addImageModal').modal('hide');
    uploader[0].dropzone.removeAllFiles();
    $('#media').load('includes/generators/medialist.php');
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
    var newname = $('#newMediaName').val();
    var id = $('newMediaName').attr('php-media-id');
    $.post('../includes/actions/renamemedia.php', {id: id, newname: newname}, function(data){
      if (data == "success") {

      } else {
        alert('Sorry, probeer het later opnieuw');
      }
    });
  });
});
