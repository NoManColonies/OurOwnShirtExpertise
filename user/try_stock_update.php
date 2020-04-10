<?php
require_once('../.confiq/confiq.php');
$length = ($_REQUEST['l'] == "u")? "NULL" : "'".$_REQUEST['l']."'";
$query = "select * from producttable where productname='".$_REQUEST['a']."' and productsize='".$_REQUEST['s']."' and productlength=".$length;
$retreive_product_result = $connect->query($query);
if (!empty($retreive_product_result->num_rows)) {
  $product_row = $retreive_product_result->fetch_assoc();
  $query = "update producttable set productqty=".$_REQUEST['q']." where productcode='".$product_row['productcode']."'";
  $try_to_update_product = $connect->query($query);
  if (!$try_to_update_product) {
    echo "Failed to update product. error code : ".$connect->errno." query : ".$query;
  } else {
    echo "";
  }
} else {
  echo "Failed to retreive product query : ".$query;
}
$connect->close();
?>
