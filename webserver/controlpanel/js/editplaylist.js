$(document).ready(function(){

  var playlistid = $('#playlistid').html();

  $('#addMediaBtn').on('click', function(){
    $('#addMediaModal').modal('show');
  });

  $('#mediaSelect').load('includes/generators/mediaselect.php');

  $('#confirmAddMedia').on('click', function(){

    var media = [];

    $('#mediaSelect').find('.mediaSelect').each(function(){
      if ($(this).hasClass('selected')) {
        media.push($(this).attr('php-media-id'));
      }
    });

    $.post('includes/actions/mediatoplaylist.php', {id:playlistid, media:JSON.stringify(media)}, function(data){
      if (data == "success") {
        $('#addMediaModal').modal('hide');
        $('#mediaSelect').find('.mediaSelect').each(function(){
          if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
          }
        });
        location.reload();
      } else {
        alert('Sorry, probeer het later opnieuw');
      }
    });
  });

  $('#mediaSelect').on('click', '.mediaSelect', function(){
    if ($(this).hasClass('selected')) {
      $(this).removeClass('selected');
    } else {
      $(this).addClass('selected');
    }
  });

  $('#cancelAddMedia').on('click', function(){
    $('#mediaSelect').find('table').find('tr').each(function(){
      $(this).find('td.selected').removeClass('selected');
    });
  });

  $('.move-media-up-btn').on('click', function(){
    var id = $(this).attr('php-media-id');

    $.post('includes/actions/movemedia.php', {id:id, playlistid:playlistid, action:"up"}, function(data){
      if (data != "success") {
        alert('Sorry, probeer het later opnieuw');
      } else {
        location.reload();
      }
    });
  });

  $('.move-media-down-btn').on('click', function(){
    var id = $(this).attr('php-media-id');

    $.post('includes/actions/movemedia.php', {id:id, playlistid:playlistid, action:"down"}, function(data){
      if (data != "success") {
        alert('Sorry, probeer het later opnieuw');
      } else {
        location.reload();
      }
    });
  });

  $('.delete-media-btn').on('click', function(){
    var id = $(this).attr('php-media-id');
    $('#removeMediaModalBtn').attr('php-media-id', id);
    $('#removeMediaModal').modal('show');
  });

  $('#removeMediaModalBtn').on('click', function(){
    var id = $(this).attr('php-media-id');
    $.post('includes/actions/removemedia.php', {id:id, playlistid:playlistid}, function(data){
      if (data == "success") {
        $('#removeMediaModal').modal('hide');
        location.reload();
      } else {
        alert('Sorry, probeer het later opnieuw!');
      }
    });
  });
});
