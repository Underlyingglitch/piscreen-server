(function($) {
  $.fn.inputFilter = function(inputFilter) {
    return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
      if (inputFilter(this.value)) {
        this.oldValue = this.value;
        this.oldSelectionStart = this.selectionStart;
        this.oldSelectionEnd = this.selectionEnd;
      } else if (this.hasOwnProperty("oldValue")) {
        this.value = this.oldValue;
        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
      } else {
        this.value = "";
      }
    });
  };
}(jQuery));

$(document).ready(function(){
  $('#newPlayerIP').ipAddress();
  $('#newPlayerCode').inputFilter(function(value){
    return /^\d*$/.test(value);
  });

  $('#create-player-toggle').on('click', function(){
    $('#addPlayer').modal('toggle');
  });

  $('#addPlayerBtn').on('click', function(){
    var newPlayerName = $('#newPlayerName').val();
    var newPlayerIP = $('#newPlayerIP').val();
    var newPlayerCode = $('#newPlayerCode').val();

    if (newPlayerIP == '' || newPlayerName == '' || newPlayerCode == '') {
      alert('Niet alle velden zijn ingevuld!');
    }

    window.open('http://'+newPlayerIP+':31804/server/connect.php?name='+newPlayerName+'&code='+newPlayerCode+'&server='+serverIP,'popup','width=screen.availWidth,height=screen.availHeight');

    setTimeout(function(){
      $('#addPlayer').modal('hide');
      //Refresh page
      location.reload();
    }, 5000);
  });

  $('.select-playlist-btn').on('click', function(){
    var id = $(this).attr('php-player-id');
    $('#editPlaylistSelect').load('includes/generators/playlistselect.php');
    $('#editPlaylistSubmit').attr('php-player-id', id);
    $('#editPlaylist').modal('show');
  });

  $('#editPlaylistSubmit').on('click', function(){
    var player = $(this).attr('php-player-id');
    var playlist = $('#editPlaylistSelect').val();
    $.post('includes/actions/changeplaylist.php', {player: player, playlist: playlist}, function(data){
      if (data == "success") {
        $('#editPlaylist').modal('hide');
        location.reload();
      } else {
        alert('Sorry, probeer het later opnieuw!');
      }
    });
  });

  function checkServer(url, timeout, status) {
    const controller = new AbortController();
    const signal = controller.signal;
    const options = { mode: 'no-cors', signal };
    return fetch(url, options)
      .then(setTimeout(() => { controller.abort() }, timeout))
      .then(response => {
        status.html('Online!');
        status.css('background-color', 'green');
      })
      .catch(error => {
        status.html('Offline!');
        status.css('background-color', 'red');
      });
  }

  function getStatus() {
    $('#players').find('tr').each(function(index, value){
      var tds = $(this).find('td'),
          name = tds.eq(0),
          ip = tds.eq(1),
          status = tds.eq(2);

    checkServer('http://'+ip.text()+':31804/', 100, status);

      //status.html('Online!');
    });
  }

  setInterval(function(){
    getStatus();
  }, 2000);

  $('.delete-player-btn').on('click', function(){
    var id = $(this).attr('php-player-id');

    $.post('includes/actions/deleteplayer.php', {id:id}, function(data){
      if (data == "success") {
        location.reload();
      } else {
        alert('Sorry, probeer het later opnieuw');
      }
    });
  });
});
