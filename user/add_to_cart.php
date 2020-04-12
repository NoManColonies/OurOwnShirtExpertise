<?php
require_once('../.confiq/auth_confiq.php');
if (session_restore_result($connect)['session_valid']) {
  $length = ($_REQUEST['l'] == "" || $_REQUEST['l'] == "u")? "" : " and productlength='".$_REQUEST['l']."'";
  $query = "select productcode from producttable where productname='".$_REQUEST['a']."' and productsize='".$_REQUEST['s']."'".$length;
  $retreive_distinct_product_result = $connect->query($query);
  if (!empty($retreive_distinct_product_result->num_rows)) {
    $product_row = $retreive_distinct_product_result->fetch_assoc();
    if (add_to_cart($connect, $listmanager, $product_row['productcode'], $_REQUEST['q'], true)) {
      echo "";
    } else {
      echo "Failed to add product to cart at add_to_cart function.";
    }
  } else {
    echo "Failed to add product to cart at retreive productcode process.";
  }
} else {
  echo "Session expire before add product to cart process.";
}
$listmanager->close();
$connect->close();
?>
