$(document).ready(function(){
  $('.edit-playlist-btn').on('click', function(){
    var playlist = $(this).attr('php-playlist-id');

    location.assign("editplaylist.php?id="+playlist);
  });

  $('.delete-playlist-btn').on('click', function(){
    var playlist = $(this).attr('php-playlist-id');

    $('#confirmDeleteId').html(playlist);
    $('#confirmDeletePlaylist').attr('php-playlist-id', playlist);
    $('#deletePlaylistConfirmModal').modal('show');
  });

  $('#confirmDeletePlaylist').on('click', function(){
    var playlist = $(this).attr('php-playlist-id');

    $.post('includes/actions/deleteplaylist.php', {id: playlist}, function(data){
      if (data == "success") {
        $('#deletePlaylistConfirmModal').modal('close');
        location.reload();
      } else {
        alert('Sorry, probeer het later opnieuw!');
      }
    })
  })
});
