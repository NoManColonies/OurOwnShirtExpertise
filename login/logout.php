<?php
  require_once("../.confiq/confiq.php");
  if (isset($_COOKIE['current_userid'] && $_COOKIE['current_userid'] != null && isset($_COOKIE['encrypted_hashkey']) && $_COOKIE['encrypted_hashkey'] != null)) {
    $userid = $_COOKIE['current_userid'];
    $logoutresult = $connect->query("update usercredentials set userhashkey=null where userid='".$userid."'");
    $connect->close();
    if (!$logoutresult) {
      printf("Failed to log out. it seen like your userid does not exists : fetal.");
      exit();
    }
  } else {
    unset($_COOKIE['current_userid']);
    unset($_COOKIE['encrypted_administration_key']);
    unset($_COOKIE['encrypted_hash_key']);
    echo "<script type=\"text/javascript\">";
    echo "alert(\"session expired logging out automatically.\");";
    echo "</script>";
    $connect->close();
    header("Location: https://worawanbydiistudent.store/index.php");
  }
?>
