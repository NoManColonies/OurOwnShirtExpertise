<?php
require_once('../.confiq/confiq.php');
$session = session_auth_check($connect);
if ($session['session_valid'] && $session['auth_key_valid']) {
  $query = "select * from stockrequest where keyhash='".$_REQUEST['q']."'";
  $retreive_billinglist = $connect->query($query);
  if (!empty($retreive_billinglist->num_rows)) {
    $billing_row = $retreive_billinglist->fetch_assoc();
    $query = "insert into approvedrequest (aid, status, userid, itemid, itemqty, keyhash) values(NULL, '".$billing_row['status'].$_REQUEST['s']."', '".$billing_row['userid']."', '".$billing_row['itemid']."', '".$billing_row['itemqty']."', '".$billing_row['keyhash']."')";
    $try_to_process_billinglist_result = $connect->query($query);
    if ($try_to_process_billinglist_result) {
      $query = "update stockrequest set status='".$billing_row['status'].$_REQUEST['s']."' where keyhash='".$billing_row['keyhash']."'";
      $try_to_process_billinglist_result = $connect->query($query);
      if (!$try_to_process_billinglist_result) {
        echo "Failed to set status for pending list. error code : ".$connect->errno." query : ".$query;
      } else {
        $query = "update billinglist set status='".$billing_row['status'].$_REQUEST['s']."' where keyhash='".$billing_row['keyhash']."'";
        $try_to_process_billinglist_result = $connect->query($query);
        if (!$try_to_process_billinglist_result) {
          echo "Failed to set status for billing list. error code : ".$connect->errno." query : ".$query;
        }
      }
    } else {
      echo "Failed to process billing list. error code : ".$connect->errno." query : ".$query;
    }
  } else {
    echo "Failed to retreive billinglist error code : ".$connect->errno." query : ".$query;
  }
}
$connect->close();
?>
