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

          $this->loginTime($i);
          $this->loginIP($i);

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

  function loginTime($i) {
    $json = file_get_contents($this->data_path.'users/controlpanel_users.json');
    $userarray = json_decode($json, true);

    $dateTime = new \DateTime();

    $time = $dateTime->format('d-m-Y H:i:s');

    $userarray[$i]['last_login'] = (string)$time;

    file_put_contents($this->data_path.'users/controlpanel_users.json', json_encode($userarray));

    return true;
  }

  function loginIP($i) {
    $json = file_get_contents($this->data_path.'users/controlpanel_users.json');
    $userarray = json_decode($json, true);

    $ip = $_SERVER['REMOTE_ADDR'];

    $userarray[$i]['last_ip_address'] = (string)$ip;

    file_put_contents($this->data_path.'users/controlpanel_users.json', json_encode($userarray));

    return true;
  }

  function logout() {
    session_unset();
    session_destroy();

    return true;
  }



}

?>
