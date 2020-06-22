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

  function setPlayerStatus(status) {

  }

  function checkServer(url, timeout, status) {
    const controller = new AbortController();
    const signal = controller.signal;
    const options = { mode: 'no-cors', signal };
    return fetch(url, options)
      .then(setTimeout(() => { controller.abort() }, timeout))
      .then(response => status.html('Online!'))
      .catch(error => status.html('Offline!'));
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
});
