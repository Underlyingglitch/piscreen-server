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
        $('#deletePlaylistConfirmModal').modal('hide');
        location.reload();
      } else {
        alert('Sorry, probeer het later opnieuw!');
      }
    })
  });

  $('#create-playlist-toggle').on('click', function(){
    $('#createPlaylistModal').modal('show');
  });

  $('#confirmCreatePlaylist').on('click', function(){
    var name = $('#newPlaylistName').val();

    $.post('includes/actions/createplaylist.php', {name: name}, function(data){
      if (data == "success") {
        $('#createPlaylistModal').modal('hide');
        location.reload();
      } else {
        alert("Fout bij het aanmaken van de afspeellijst, probeer het later opnieuw");
        console.log(data);
      }
    });
  });
});
