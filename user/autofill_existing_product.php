<?php
require_once('../.confiq/confiq.php');
$retreive_product_result = $connect->query("select * from producttable where productname='".$_REQUEST['q']."'");
if (!empty($retreive_product_result->num_rows)) {
  $product_row = $retreive_product_result->fetch_assoc();
  echo $product_row['producttitle'].",".$product_row['productdescription'].",".$product_row['productgender'].",".$product_row['productimagepath'];
} else {
  echo ",,,";
}
$connect->close();
?>
