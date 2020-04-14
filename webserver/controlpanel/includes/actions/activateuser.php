<?php

$json = file_get_contents('../../../data/users/controlpanel_users.json');
$userarray = json_decode($json, true);


//Getting userid
for ($i=0; $i<count($userarray); $i++) {
  if ($userarray[$i]['username'] === $_POST['username']) {
    break;
  }
}

$userarray[$i]['blocked'] = 0;

file_put_contents('../../../data/users/controlpanel_users.json', json_encode($userarray));

echo "success";

?>
