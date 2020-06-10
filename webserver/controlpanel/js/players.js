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

    // $.post('http://'+newPlayerIP+':31804/server/connect.php', {name: newPlayerName, code: newPlayerCode}, function(data){
    //   if (data == "success") {
    //     $.post('includes/actions/saveplayerinfo.php', {code: newPlayerCode, name: newPlayerName, ip: newPlayerIP}, function(data){
    //       if (data == "success") {
    //         $.post('http://'+newPlayerIP+':31804/server/reboot.php', function(){
    //           $('#addPlayer').modal('toggle');
    //           $('#newPlayerName').val('');
    //           $('#newPlayerIP').val('');
    //           $('#newPlayerCode').val('');
    //         });
    //       } else {
    //         //TODO: add status code
    //         alert('Error while trying to save data');
    //       }
    //     });
    //   } else {
    //     alert('Waarschuwing: fout bij het toevoegen van de player. Probeer het later nog eens!');
    //   }
    // });
  });

  function getStatus(ip) {
    //TODO: refresh status every .. seconds
  }
});
