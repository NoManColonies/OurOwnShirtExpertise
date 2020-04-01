<?php
require_once('../.confiq/confiq.php');
function login_test_result(mysqli $connectt, $server_url, $username, $vulnerable_password) {
  if (is_null($username)) {
    $try_to_get_passkey_tmp_string = ['userpassword' => 'keynotavailable'];
  } else {
    $try_to_get_passkey_tmp = $connectt->query("select * from userbasicdata");
    if (empty($try_to_get_passkey_tmp)) {
      error_alert($connect, "Something is wrong with this. error code : ".$connect->errno);
    }
    while ($try_to_get_passkey_tmp_string = $try_to_get_passkey_tmp->fetch_assoc()) {
      if ($try_to_get_passkey_tmp_string['userid'] == $username) {
        $encrypted_password_tmp = $try_to_get_passkey_tmp_string['userpassword'];
        break;
      }
    }
  }
  if (password_verify($vulnerable_password, $encrypted_password_tmp) && !empty($try_to_get_passkey_tmp->num_rows)) {
    $decrypted_hash_key_tmp = random_string();
    $encrypted_hash_key_tmp = argon2_encrypt($decrypted_hash_key_tmp);
    $_SESSION['encrypted_hash_key1'] = $encrypted_hash_key_tmp;
    $_SESSION['current_userid'] = $username;
    $hash_key_update_result = $connectt->query("update usercredentials set userhashkey='".$decrypted_hash_key_tmp."' where userid='".$username."'");
    if(!$hash_key_update_result) {
      session_unset();
      session_destroy();
      alert_message("Process failed during server userhashkey update : ".$username.". hashkey : ".$decrypted_hash_key_tmp.". error code : ".$connect->errno.". logging out...");
    } else {
      $decrypted_hash_key_tmp = random_string();
      $encrypted_hash_key_tmp = argon2_encrypt($decrypted_hash_key_tmp);
      $_SESSION['encrypted_hash_key2'] = $encrypted_hash_key_tmp;
      $hash_key_update_result = $connectt->query("update usercredentials set usersecondhashkey='".$decrypted_hash_key_tmp."' where userid='".$username."'");
      if (!$hash_key_update_result) {
        alert_message("Failed to secure second hashkey. error code : ".$connect->errno);
      } else {
        $decrypted_hash_key_tmp = random_string();
        $encrypted_hash_key_tmp = argon2_encrypt($decrypted_hash_key_tmp);
        $_SESSION['encrypted_hash_key3'] = $encrypted_hash_key_tmp;
        $hash_key_update_result = $connectt->query("update usercredentials set userbackuphashkey='".$decrypted_hash_key_tmp."' where userid='".$username."'");
        if (!$hash_key_update_result) {
          alert_message("Failed to secure backup hashkey. error code : ".$connect->errno);
        } else {
          $client_ip = new Getip();
          $encrypted_ip = argon2_encrypt($client_ip->get_ip_address());
          $_SESSION['encrypted_ip'] = $encrypted_ip;
          $session_ip_update_result = $connectt->query("update usercredentials set usersessionip='".$client_ip."' where userid='".$userid."'");
          if (!$session_ip_update_result) {
            alert_message("Failed to secure user ipaddress. backup hashkey are no longer accessible until next successful restore. error code : ".$connect->errno);
          }
        }
      }
    }
    $connect->close();
    return true;
  }
  $connect->close();
  return false;
}
?>
