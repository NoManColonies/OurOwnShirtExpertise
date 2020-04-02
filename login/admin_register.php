<?php
require_once('../.confiq/confiq.php');
$admin_register_result = $connect->query("insert into usercredentials (uid, userid, username, userlastname, userpassword, useraccesskey) values(NULL, '', '', '', '".argon2_encrypt('')."', '".argon2_encrypt('')."')");
if (!$admin_register_result) {
  error_alert($connect, "Admin registeration failed.");
}
$admin_basicdata_register_result = $connect->query("insert into userbasicdata (did, primaryaddress, secondaryaddress, city, state, province, postnum, phonenumber, emailaddress) values(NULL, 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL')");
if (!$admin_basicdata_register_result) {
  error_alert($connect, "Admin basicdata registeration failed.");
}
login_retry_redirect($connect, "Registeration successful. please try to login.");
?>
