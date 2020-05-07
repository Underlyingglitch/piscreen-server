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
});
