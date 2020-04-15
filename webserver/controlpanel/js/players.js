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

    $.post('http://'+newPlayerIP+':1234/server.php', {code: newPlayerCode, name: newPlayerName}, function(data){
      if (data == "success") {
        //Successfully configured player, adding to local DB

      } else {
        alert("Waarschuwing: fout bij het toevoegen van de player. Probeer het later nog eens! Fout: "+data);
      }
    });
  });

  function getStatus() {

  }
});
