$(document).ready(function(){
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
      $('#players').load('includes/generators/playerspage.php');
    }, 5000);
  });

  function getStatus(ip) {
    //TODO: refresh status every .. seconds
  }
});
