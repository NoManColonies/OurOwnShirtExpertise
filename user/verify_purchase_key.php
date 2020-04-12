<?php
require_once('../.confiq/confiq.php');
$session = session_restore_result($connect);
if ($session['session_valid']) {
  $query = "select * from billinglist where keyhash='".$_REQUEST['q']."'";
  $validate_billinglist_key_result = $connect->query($query);
  if (empty($validate_billinglist_key_result->num_rows)) {
    echo "Failed to retreive result from provided key. query : ".$query;
  } else {
    echo "";
  }
} else {
  echo "Failed to restore session.";
}
$connect->close();
?>
