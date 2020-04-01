<?php
$server = "localhost";
$server_url = "worawanbydiistudent.store";
$user = "";
$password = "";
$database = "";
$connect = new mysqli($server, $user, $password, $database);
if ($connect->connect_errno) {
  alert_message("Connection timed out for user : ".$user." error code : ".$connect->errno);
  $connect->close();
}
session_start();
function error_alert(mysqli $connect, $content) {
  echo "<script>alert(\"".$content."\");</script>";
  $connect->close();
  header("Location: https://worawanbydiistudent.store/index.php");
}
function log_alert(mysqli $connect, $content) {
  echo "<script>alert(\"".$content."\");</script>";
  $connect->close();
}
function admin_redirect(mysqli $connect, $content) {
  echo "<script>alert(\"".$content."\");</script>";
  $connect->close();
  header("Location: https://worawanbydiistudent.store/authorities/product_add.php");
}
function login_retry_redirect(mysqli $connect, $content) {
  echo "<script>alert(\"".$content."\");</script>";
  $connect->close();
  header("Location: https://worawanbydiistudent.store/login/login.php");
}
function alert_message($content) {
  echo "<script>alert(\"".$content."\");</script>";
}
function argon2_encrypt($text) {
  return password_hash($text, PASSWORD_ARGON2I);
}
function random_string() {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_+=~/?>.,<\|฿';
  $characters_length = strlen($characters);
  $random_string = '';
  $length = 5;
  for ($i = 0; $i < $length; $i++) {
    $random_string .= $characters[rand(0, $characters_length - 1)];
  }
  return $random_string;
}
function session_auth_check(mysqli $connect, $server_url) {
  $session = session_restore_result($connect, $server_url);
  if ($session['session_valid']) {
    if (password_verify('', $session['auth_key'])) {
      return [
        'session_valid' => true,
        'auth_key_valid' => true
      ];
    } else {
      return [
        'session_valid' => true,
        'auth_key_valid' => false
      ];
    }
  } else {
    return [
      'session_valid' => false,
      'auth_key_valid' => false
    ];
  }
}
function session_restore_result(mysqli $connect, $server_url) {
  if(isset($_COOKIE['current_userid']) && !is_null($_COOKIE['current_userid']) && isset($_COOKIE['encrypted_hash_key']) && !is_null($_COOKIE['encrypted_hash_key'])) {
    $userid = $_COOKIE['current_userid'];
    $server_decrypted_hash_key = $connect->query("select * from usercredentials where userid='".$userid."'");
    if ($server_decrypted_hash_key->num_rows == 0) {
      error_alert($connect, "Could not detect user account from cookie. this shouldn't happen and should be checked before.");
    }
    $row = $server_decrypted_hash_key->fetch_assoc();
    if (password_verify($row['userhashkey'], $_COOKIE['encrypted_hash_key'])) {
      $decrypted_hash_key = random_string();
      $encrypted_hash_key = argon2_encrypt($decrypted_hash_key);
      setcookie('encrypted_hash_key', $encrypted_hash_key, time() + 3600, '/', $server_url, true, true);
      setcookie('current_userid', $userid, time() + 3600, '/', $server_url, true, true);
      $hash_key_update_result = $connect->query("update usercredentials set userhashkey='".$decrypted_hash_key."' where userid='".$userid."'");
      if (!$hash_key_update_result) {
        setcookie('encrypted_hash_key', NULL, -1, '/', $server_url, true, true);
        setcookie('current_userid', NULL, -1, '/', $server_url, true, true);
        error_alert($connect, "Failed to update userhashkey.");
      }
      return [
        'session_valid' => true,
        'auth_key' => $row['useraccesskey']
      ];
    } else {
      $hash_key_update_result = $connect->query("update usercredentials set userhashkey=NULL where userid='".$userid."'");
      setcookie('current_userid', NULL, -1, '/', $server_url, true, true);
      setcookie('encrypted_hash_key', NULL, -1, '/', $server_url, true, true);
      if (!$hash_key_update_result) {
        error_alert($connect, "Destroy server hashkey failed. userid : '".$userid."' doesn't exists on server. this shouldn't occur as we already checked before.");
      }
      return [
        'session_valid' => false,
        'auth_key' => NULL
      ];
    }
  } else {
    setcookie('current_userid', NULL, -1, '/', $server_url, true, true);
    setcookie('encrypted_hash_key', NULL, -1, '/', $server_url, true, true);
    return [
      'session_valid' => false,
      'auth_key' => NULL
    ];
  }
}
function login_result(mysqli $connect, $server_url, $username, $vulnerable_password) {
  if (is_null($username)) {
    $try_to_get_passkey_tmp_string = ['userpassword' => 'keynotavailable'];
  } else {
    $try_to_get_passkey_tmp = $connect->query("select userpassword from usercredentials where userid='".$username."'");
    $try_to_get_passkey_tmp_string = $try_to_get_passkey_tmp->fetch_assoc();
  }
  if (password_verify($vulnerable_password, $try_to_get_passkey_tmp_string['userpassword']) && !empty($try_to_get_passkey_tmp->num_rows)) {
    $decrypted_hash_key_tmp = random_string();
    $encrypted_hash_key_tmp = argon2_encrypt($decrypted_hash_key_tmp);
    $encrypted_administration_key_tmp = $connect->query("select * from usercredentials where userid='".$username."'");
    $encrypted_administration_key_tmp_string = $encrypted_administration_key_tmp->fetch_assoc();
    setcookie('encrypted_hash_key', $encrypted_hash_key_tmp, time() + 3600, '/', $server_url, true, true);
    setcookie('current_userid', $username, time() + 3600, '/', $server_url, true, true);
    $hash_key_update_result = $connect->query("update usercredentials set userhashkey='".$decrypted_hash_key_tmp."' where userid='".$username."'");
    if(!$hash_key_update_result) {
      setcookie('encrypted_hash_key', NULL, -1, '/', $server_url, true, true);
      setcookie('current_userid', NULL, -1, '/', $server_url, true, true);
      error_alert($connect, "Process failed during server userhashkey update : ".$username." hashkey : ".$decrypted_hash_key_tmp.".");
    }
    return true;
  }
  return false;
}
?>
