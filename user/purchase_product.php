<?php
require_once('../.confiq/auth_confiq.php');
$session = session_restore_result($connect);
if ($session['session_valid']) {
  $retreive_cartlist = $listmanager->query("select * from ".$_SESSION['current_userid']."_cartlist where status=1");
  if (!empty($retreive_cartlist->num_rows)) {
    $product_code_string = "";
    $product_qty_string = "";
    $check_bit = false;
    while ($row = $retreive_cartlist->fetch_assoc()) {
      $query = "select * from producttable where productcode='".$row['itemcode']."'";
      $check_for_stock_result = $connect->query($query);
      if (!empty($check_for_stock_result->num_rows)) {
        $stock_row = $check_for_stock_result->fetch_assoc();
        if ($stock_row['productqty'] < $row['itemqty']) {
          $check_bit = true;
          echo "Item name: ".$stock_row['productname'].". you ordered is higher than available in stock.";
        } else {
          $product_code_string .= (empty($product_code_string))? $row['itemcode'] : ",".$row['itemcode'];
          $product_qty_string .= (empty($product_qty_string))? $row['itemqty'] : ",".$row['itemqty'];
        }
      } else {
        $check_bit = true;
        echo "Failed to retreive item from stock. query : ".$query;
      }
    }
    if (!$check_bit) {
      $retreive_cartlist = $listmanager->query("select * from ".$_SESSION['current_userid']."_cartlist where status=1");
      if (!empty($retreive_cartlist->num_rows)) {
        while ($row = $retreive_cartlist->fetch_assoc()) {
          $query = "update ".$_SESSION['current_userid']."_cartlist set status=0 where itemcode='".$row['itemcode']."'";
          $cartlist_update_result = $listmanager->query($query);
          if (!$cartlist_update_result) {
            $check_bit = true;
            echo "Failed to update your cartlist. query : ".$query." aborting...";
            break;
          }
        }
        if (!$check_bit) {
          $query = "select uid from usercredentials where userid='".$_SESSION['current_userid']."'";
          $retreive_user_uid = $connect->query($query);
          if (!empty($retreive_user_uid->num_rows)) {
            $user_row = $retreive_user_uid->fetch_assoc();
            $keyhash = random_string().random_string().random_string().$user_row['uid'];
            $query = "insert into billinglist (bid, status, userid, itemid, itemqty, keyhash) values(NULL, NULL, '".$_SESSION['current_userid']."', '".$product_code_string."', '".$product_qty_string."', '".$keyhash."')";
            $update_billinglist_result = $connect->query($query);
            if (!$update_billinglist_result) {
              echo "Failed to push into billinglist. query : ".$query;
            } else {
              echo $keyhash;
            }
          } else {
            echo "Failed to retreive your userid. query : ".$query;
          }
        }
      } else {
        echo "Process failed between order processing. this should not occur and should be checked before.";
      }
    } else {
      echo " Process terminated after recent error please try again.";
    }
  }
} else {
  echo "Session restore failed.";
}
$listmanager->close();
$connect->close();
?>
