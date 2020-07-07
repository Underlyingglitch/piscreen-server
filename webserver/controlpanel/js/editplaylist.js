$(document).ready(function(){

  var playlistid = $('#playlistid').html();

  $('#addMediaBtn').on('click', function(){
    $('#addMediaModal').modal('show');
  });

  $('#imgSelect').load('includes/generators/imgselect.php');

  $('#confirmAddImgs').on('click', function(){

    var imgs = [];

    $('#imgSelect').find('table').find('img').each(function(){
      if ($(this).hasClass('selected')) {
        imgs.push($(this).attr('php-img-id'));
      }
    });

    $.post('includes/actions/imgtoplaylist.php', {id:playlistid, imgs:JSON.stringify(imgs)}, function(data){
      if (data == "success") {
        $('#addMediaModal').modal('hide');
        $('#imgSelect').find('table').find('img').each(function(){
          if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
          }
        });
        location.reload();
      } else {
        alert('Sorry, probeer het later opnieuw');
      }
    })
  });

  $('#imgSelect').on('click', '.imgSelect', function(){
    if ($(this).hasClass('selected')) {
      $(this).removeClass('selected');
    } else {
      $(this).addClass('selected');
    }
  });

  $('#cancelAddImgs').on('click', function(){
    $('#imgSelect').find('table').find('tr').each(function(){
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
});
