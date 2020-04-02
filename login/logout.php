<?php
  require_once("../.confiq/confiq.php");
  if (isset($_SESSION['current_userid']) && !is_null($_SESSION['current_userid']) && isset($_SESSION['encrypted_hash_key1']) && !is_null($_SESSION['encrypted_hash_key1'])) {
    $userid = $_SESSION['current_userid'];
    $logout_result = $connect->query("update usercredentials set userhashkey=NULL, usersecondhashkey=NULL, userbackuphashkey=NULL, usersessionip=NULL where userid='".$userid."'");
    if (!$logout_result) {
      session_unset();
      session_destroy();
      error_alert($connect, "Failed to log out. it seen like your userid does not exists. error code : ".$connect->errno.". logging out automatically...");
    }
    session_unset();
    session_destroy();
    $connect->close();
  } else {
    session_unset();
    session_destroy();
    error_alert($connect, "Session expired. logging out automatically...");
  }
  header("Location: https://worawanbydiistudent.store/index.php");
?>
