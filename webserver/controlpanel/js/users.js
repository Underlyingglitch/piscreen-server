$(document).ready(function(){
  $('.role-edit-btn').on('click', function(){
    var username = $(this).attr('username');

    $.post('includes/generators/roleeditor.php', {username: username}, function(data){
      $('#roleEditorTitle').html('Bewerk rollen voor: '+username);
      $('#roleEditorBody').html(data);
    });
    $('#roleEditor').modal('toggle');
  });

  $('.change-password-btn').on('click', function(){
    var username = $(this).attr('username');

    $('#username').val(username);

    $('#changePasswordTitle').html('Bewerk wachtwoord voor: '+username);
    $('#changePassword').modal('toggle');
  });

  $('#changePasswordSave').on('click', function(){
    var password = $('#newPassword').val();
    var repeatPassword = $('#repeatNewPassword').val();
    var username = $('#username').val();

    if (password == repeatPassword) {
      $.post('includes/actions/changepassword.php', {username: username, password: password}, function(data){
        if (data == "success") {
          $('#changePassword').modal('toggle');
          $('#newPassword').val('');
          $('#repeatNewPassword').val('');
          $('#username').val('');
        } else {
          alert('Error bij het opslaan, probeer het later opnieuw');
        }
      });
    } else {
      alert('Wachtwoorden komen niet overeen!');
    }
  });

  $('.block-user-btn').on('click', function(){
    var username = $(this).attr('username');

    $('#blockUserBody').html('Weet u zeker dat u <strong>'+username+'</strong> wilt blokkeren?');
    $('#blockUserTitle').html('Blokkeer: '+username);
    $('#proceed-block').attr('username', username);
    $('#blockUser').modal('toggle');
  });

  $('#proceed-block').on('click', function(){
    var username = $(this).attr('username');

    $.post('includes/actions/blockuser.php', {username: username}, function(data){
      if (data == "success") {
        $('#blockUser').modal('toggle');
        location.reload();
      } else {
        alert('Fout bij blokkeren, probeer het later opnieuw');
      }
    });
  });

  $('.activate-user-btn').on('click', function(){
    var username = $(this).attr('username');

    $('#activateUserBody').html('Weet u zeker dat u <strong>'+username+'</strong> wilt activeren?');
    $('#activateUserTitle').html('Blokkeer: '+username);
    $('#proceed-activation').attr('username', username);
    $('#activateUser').modal('toggle');
  });

  $('#proceed-activation').on('click', function(){
    var username = $(this).attr('username');

    $.post('includes/actions/activateuser.php', {username: username}, function(data){
      if (data == "success") {
        $('#activateUser').modal('toggle');
        location.reload();
      } else {
        alert('Fout bij activeren, probeer het later opnieuw');
      }
    });
  });

  $('.delete-btn').on('click', function(){
    var username = $(this).attr('username');

    $.post('includes/actions/deleteuser.php', {username: username}, function(data){
      if (data == "success") {
        location.reload();
      } else {
        alert('Waarschuwing: verwijderen niet voltooid! Probeer het later opnieuw');
      }
    });
  });
});
