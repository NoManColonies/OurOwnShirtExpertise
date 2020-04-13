<?php
require_once('../.confiq/confiq.php');
if (session_restore_result($connect)['session_valid']) {
  $try_to_retreive_password_result = $connect->query("select * from usercredentials where userid='".$_SESSION['current_userid']."'");
  if (!empty($try_to_retreive_password_result->num_rows)) {
    $row = $try_to_retreive_password_result->fetch_assoc();
    if (password_verify($_REQUEST['oldpassword'], $row['userpassword'])) {
      if ($_REQUEST['newpassword'] == $_REQUEST['repassword']) {
        $try_encrypt_new_password_result = $connect->query("update usercredentials set userpassword='".argon2_encrypt($_REQUEST['newpassword'])."' where userid='".$_SESSION['current_userid']."'");
      } else {
        echo "Two new password are not the same. password1 : ".$_REQUEST['newpassword']." password2 : ".$_REQUEST['repassword'];
      }
    } else {
      echo "Password did not match.";
    }
  } else {
    echo "Unable to locate your password.";
  }
} else {
  echo "Session restore failed.";
}
$connect->close();
?>
