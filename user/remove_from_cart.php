<?php
require_once('../.confiq/auth_confiq.php');
if (remove_from_cart($connect, $listmanager, $_REQUEST['q'], $_REQUEST['a'])) {
  echo "q";
} else {
  echo "";
}
$listmanager->close();
$connect->close();
?>
