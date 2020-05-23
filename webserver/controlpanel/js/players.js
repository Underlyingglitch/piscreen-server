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

    var data = {
      name: newPlayerName,
      code: newPlayerCode
    };

    $.ajax({
      type: "PUT",
      url: newPlayerIP+":31804/server/connect.php",
      data: JSON.stringify(data),
      contentType: "application/json",
      dataType: "json",
      success: function(response) {
        $.post('includes/actions/saveplayerinfo.php', {code: newPlayerCode, name: newPlayerName, ip: newPlayerIP}, function(data){
          if (data == "success") {
            $.post('http://'+newPlayerIP+':31804/server/reboot.php', function(){
              $('#addPlayer').modal('toggle');
              $('#newPlayerName').val('');
              $('#newPlayerIP').val('');
              $('#newPlayerCode').val('');
            });
            //TODO: refresh players list
          } else {
            //TODO: add status code
            alert('Error while trying to save data');
          }
        });
      },
      failure: function(error) {
        alert("Waarschuwing: fout bij het toevoegen van de player. Probeer het later nog eens! Fout: "+error);
      }
    });
  });

  function getStatus(ip) {
    //TODO: refresh status every .. seconds
  }
});
