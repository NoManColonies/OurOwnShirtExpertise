<?php
  require_once("../.confiq/confiq.php");
  if (isset($_COOKIE['current_userid'] && $_COOKIE['current_userid'] != null && isset($_COOKIE['encrypted_hashkey']) && $_COOKIE['encrypted_hashkey'] != null)) {
    $userid = $_COOKIE['current_userid'];
    $logoutresult = mysqli_query($connect, "update usercredentials set userhashkey=null where userid='$userid'");
    mysqli_close($connect);
    if (!$logoutresult) {
      die("Failed to log out. it seen like your userid does not exists : fetal.");
    }
  } else {
    unset($_COOKIE['current_userid']);
    unset($_COOKIE['encrypted_administration_key']);
    unset($_COOKIE['encrypted_hash_key']);
    echo "<script type=\"text/javascript\">";
    echo "alert(\"session expired logging out automatically.\");";
    echo "</script>";
    mysqli_close($connect);
    $ss
    header("Location: https://worawanbydiistudent.store/index.php");
  }
?>
