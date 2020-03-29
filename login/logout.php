<?php
  require_once("../.confiq/confiq.php");
  if (isset($_COOKIE['current_userid']) && $_COOKIE['current_userid'] != null && isset($_COOKIE['encrypted_hashkey']) && $_COOKIE['encrypted_hashkey'] != null) {
    $userid = $_COOKIE['current_userid'];
    $logout_result = $connect->query("update usercredentials set userhashkey=0 where userid='".$userid."'");
    $connect->close();
    if (!$logout_result) {
      printf("Failed to log out. it seen like your userid does not exists : fetal.");
      exit();
    }
  } else {
    if (isset($_COOKIE['current_userid'])) {
      setcookie('current_userid', null, -1, '/', $server_url, false, true);
    }
    if (isset($_COOKIE['encrypted_hash_key'])) {
      setcookie('encrypted_hash_key', null, -1, '/', $server_url, false, true);
    }
    echo "<script type=\"text/javascript\">";
    echo "console.log(\"session expired logging out automatically.\");";
    echo "</script>";
    $connect->close();
    header("Location: https://worawanbydiistudent.store/index.php");
  }
?>
