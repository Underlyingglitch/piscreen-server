<?php

session_start();

class Auth {

  private $data_path = "../../../data/";


  function login($username, $password) {
    $username = htmlspecialchars(stripslashes($username));
    $password = htmlspecialchars(stripslashes($password));

    $json = file_get_contents($this->data_path.'users/controlpanel_users.json');
    $userarray = json_decode($json, true);

    for ($i=0; $i<count($userarray); $i++) {
      if ($userarray[$i]['username'] === $username) {
        if ($userarray[$i]['password'] === $password) {
          //Details correct!
          $_SESSION['auth'] = $username;
          $_SESSION['id'] = $i;

          return "success";
        } else {
          //Incorrect password
          return "incorrectpassword";
        }
      } else {
        //Incorrect username
        return "usernotfound";
      }
    }
  }



}

?>
