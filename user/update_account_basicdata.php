<?php
require_once('../.confiq/confiq.php');
if (session_restore_result($connect)['session_valid']) {
  $retreive_usercredentials = $connect->query("select * from usercredentials where userid='".$_SESSION['current_userid']."'");
  if (!empty($retreive_usercredentials->num_rows)) {
    $row = $retreive_usercredentials->fetch_assoc();
    $try_to_update_usercredentials = $connect->query("update usercredentials set username='".$_REQUEST['username']."', userlastname='".$_REQUEST['userlastname']."' where userid='".$_SESSION['current_userid']."'");
    if ($try_to_update_usercredentials) {
      $try_to_update_basicdata_result = $connect->query("update userbasicdata set primaryaddress='".$_REQUEST['primaryaddress']."', secondaryaddress='".$_REQUEST['secondaryaddress']."', city='".$_REQUEST['city']."', state='".$_REQUEST['state']."', province='".$_REQUEST['province']."', postnum='".$_REQUEST['postnum']."', phonenumber='".$_REQUEST['phonenumber']."', emailaddress='".$_REQUEST['emailaddress']."' where did=".$row['uid']);
      if (!$try_to_update_basicdata_result) {
        echo "Failed to update userbasicdata.";
      }
    } else {
      echo "Failed to update usercredentials.";
    }
  } else {
    echo "Failed to retreive usercredentials.";
  }
} else {
  echo "Failed to restore session.";
}
?>
