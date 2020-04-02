<?php
$server = "localhost";
$server_url = "worawanbydiistudent.store";
$user = "";
$password = "";
$database = "";
$connect = new mysqli($server, $user, $password, $database);
if ($connect->connect_errno) {
  alert_message("Connection timed out for user : ".$user.". error code : ".$connect->errno);
  exit();
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
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
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
  if(isset($_SESSION['current_userid']) && !is_null($_SESSION['current_userid']) && isset($_SESSION['encrypted_hash_key1']) && !is_null($_SESSION['encrypted_hash_key1'])) {
    $userid = $_SESSION['current_userid'];
    $server_decrypted_hash_key = $connect->query("select * from usercredentials where userid='".$userid."'");
    if ($server_decrypted_hash_key->num_rows == 0) {
      alert_message("Could not detect user account from session. this shouldn't happen and should be checked before. error code : ".$connect->errno);
      session_unset();
      return [
        'session_valid' => false,
        'auth_key' => NULL
      ];
    }
    $row = $server_decrypted_hash_key->fetch_assoc();
    if (password_verify($row['userhashkey'], $_SESSION['encrypted_hash_key1'])) {
      $decrypted_hash_key = random_string();
      $encrypted_hash_key = argon2_encrypt($decrypted_hash_key);
      $_SESSION['encrypted_hash_key1'] = $encrypted_hash_key;
      $_SESSION['current_userid'] = $userid;
      $hash_key_update_result = $connect->query("update usercredentials set userhashkey='".$decrypted_hash_key."' where userid='".$userid."'");
      if (!$hash_key_update_result) {
        alert_message("Failed to secure userhashkey. error code : ".$connect->errno);
        session_unset();
        return [
          'session_valid' => false,
          'auth_key' => NULL
        ];
      }
      $decrypted_hash_key = random_string();
      $encrypted_hash_key = argon2_encrypt($decrypted_hash_key);
      $_SESSION['encrypted_hash_key2'] = $encrypted_hash_key;
      $hash_key_update_result = $connect->query("update usercredentials set usersecondhashkey='".$decrypted_hash_key."' where userid='".$userid."'");
      if (!$hash_key_update_result) {
        alert_message("Failed to secure second hashkey. error code : ".$connect->errno);
      } else {
        $decrypted_hash_key = random_string();
        $encrypted_hash_key = argon2_encrypt($decrypted_hash_key);
        $_SESSION['encrypted_hash_key3'] = $encrypted_hash_key;
        $hash_key_update_result = $connect->query("update usercredentials set userbackuphashkey='".$decrypted_hash_key."' where userid='".$userid."'");
        if (!$hash_key_update_result) {
          alert_message("Failed to secure backup hashkey. error code : ".$connect->errno);
        }
      }
      return [
        'session_valid' => true,
        'auth_key' => $row['useraccesskey']
      ];
    } else if (password_verify($row['usersecondhashkey'], $_SESSION['encrypted_hash_key2']) && !is_null($_SESSION['encrypted_hash_key2'])) {
      $decrypted_hash_key = random_string();
      $encrypted_hash_key = argon2_encrypt($decrypted_hash_key);
      $_SESSION['encrypted_hash_key1'] = $encrypted_hash_key;
      $_SESSION['current_userid'] = $userid;
      $_SESSION['encrypted_hash_key2'] = null;
      $hash_key_update_result = $connect->query("update usercredentials set userhashkey='".$decrypted_hash_key."', usersecondhashkey=NULL where userid='".$userid."'");
      if (!$hash_key_update_result) {
        alert_message("Failed to update userhashkey. error code : ".$connect->errno);
        session_unset();
        return [
          'session_valid' => false,
          'auth_key' => NULL
        ];
      }
      return [
        'session_valid' => true,
        'auth_key' => $row['useraccesskey']
      ];
    } else if (password_verify($row['userbackuphashkey'], $_SESSION['encrypted_hash_key3']) && !is_null($_SESSION['encrypted_hash_key3'])) {
      $decrypted_hash_key = random_string();
      $encrypted_hash_key = argon2_encrypt($decrypted_hash_key);
      $_SESSION['encrypted_hash_key1'] = $encrypted_hash_key;
      $_SESSION['current_userid'] = $userid;
      $_SESSION['encrypted_hash_key2'] = null;
      $_SESSION['encrypted_hash_key3'] = null;
      $hash_key_update_result = $connect->query("update usercredentials set userhashkey='".$decrypted_hash_key."', usersecondhashkey=NULL, userbackuphashkey=NULL, usersessionip=NULL where userid='".$userid."'");
      if (!$hash_key_update_result) {
        alert_message("Failed to update userhashkey. error code : ".$connect->errno);
        session_unset();
        return [
          'session_valid' => false,
          'auth_key' => NULL
        ];
      }
      return [
        'session_valid' => true,
        'auth_key' => $row['useraccesskey']
      ];
    } else {
      $hash_key_update_result = $connect->query("update usercredentials set userhashkey=NULL, usersecondhashkey=NULL, userbackuphashkey=NULL where userid='".$userid."'");
      if (!$hash_key_update_result) {
        alert_message("Destroy server hashkey failed. userid : '".$userid."' doesn't exists on server. this shouldn't occur as we already checked before. error code : ".$connect->errno);
      }
      session_unset();
      return [
        'session_valid' => false,
        'auth_key' => NULL
      ];
    }
  } else {
    session_unset();
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
    $try_to_get_passkey_tmp = $connect->query("select * from usercredentials where userid='".$username."'");
    if (empty($try_to_get_passkey_tmp)) {
      alert_message("Cannot find your credentials.");
      return false;
    }
  }
  $row = $try_to_get_passkey_tmp->fetch_assoc();
  if (password_verify($vulnerable_password, $row['userpassword'])) {
    $decrypted_hash_key_tmp = random_string();
    $encrypted_hash_key_tmp = argon2_encrypt($decrypted_hash_key_tmp);
    $_SESSION['encrypted_hash_key1'] = $encrypted_hash_key_tmp;
    $_SESSION['current_userid'] = $username;
    $hash_key_update_result = $connect->query("update usercredentials set userhashkey='".$decrypted_hash_key_tmp."' where userid='".$username."'");
    if(!$hash_key_update_result) {
      alert_message("Process failed during server userhashkey update : ".$username.". hashkey : ".$decrypted_hash_key_tmp.". error code : ".$connect->errno.". logging out...");
    } else {
      $decrypted_hash_key_tmp = random_string();
      $encrypted_hash_key_tmp = argon2_encrypt($decrypted_hash_key_tmp);
      $_SESSION['encrypted_hash_key2'] = $encrypted_hash_key_tmp;
      $hash_key_update_result = $connect->query("update usercredentials set usersecondhashkey='".$decrypted_hash_key_tmp."' where userid='".$username."'");
      if (!$hash_key_update_result) {
        alert_message("Failed to secure second hashkey. error code : ".$connect->errno);
      } else {
        $decrypted_hash_key_tmp = random_string();
        $encrypted_hash_key_tmp = argon2_encrypt($decrypted_hash_key_tmp);
        $_SESSION['encrypted_hash_key3'] = $encrypted_hash_key_tmp;
        $hash_key_update_result = $connect->query("update usercredentials set userbackuphashkey='".$decrypted_hash_key_tmp."' where userid='".$username."'");
        if (!$hash_key_update_result) {
          alert_message("Failed to secure backup hashkey. error code : ".$connect->errno);
        }
      }
    }
    return true;
  }
  return false;
}
?>
