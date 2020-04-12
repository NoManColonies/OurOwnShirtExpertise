<?php
require_once('../.confiq/auth_confiq.php');
if (add_to_cart($connect, $listmanager, $_REQUEST['q'], $_REQUEST['a'], false)) {
  echo "q";
} else {
  echo "";
}
$listmanager->close();
$connect->close();
?>
