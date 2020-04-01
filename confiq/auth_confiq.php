<?php
require_once('confiq.php');
$cartuser = "";
$cartuserpassword = "";
$cartuserdatabase = "";
$listmanager = new mysqli($server, $cartuser, $cartuserpassword, $cartuserdatabase);
if (!$listmanager) {
  alert_message("Connection timed out for user : ".$cartuser." error code : ".$listmanager->errno);
  $listmanager->close();
}
function register_result(mysqli $connect, mysqli $listmanager, $username, $vulnerable_password, $vulnerable_password_retype, $name, $lastname, $primary_address, $secondary_address, $city, $state, $provice, $postcode, $phonenumber, $emailaddress) {
  $server_userid_check = $connect->query("select * from usercredentials");
  while($row = $server_userid_check->fetch_assoc()) {
    if ($row['userid'] == $username) {
      $listmanager->close();
      log_alert($connect, "Your username was already taken.");
      return [
        'username_valid' => false,
        'password_valid' => false,
        'email_valid' => false
      ];
    }
  }
  if ($vulnerable_password != $vulnerable_password_retype || $vulnerable_password == 'keynotavailable' || is_null($vulnerable_password)) {
    $listmanager->close();
    log_alert($connect, "Password did not match or was null.");
    return [
      'username_valid' => true,
      'password_valid' => false,
      'email_valid' => false
    ];
  }
  $encrypted_administration_key_tmp = argon2_encrypt(random_string());
  $encrypted_password_tmp = argon2_encrypt($vulnerable_password);
  $try_to_register_credentials_result = $connect->query("insert into usercredentials (uid, userid, username, userlastname, userpassword, useraccesskey) values(NULL, '".$username."', '".$name."', '".$lastname."', '".$encrypted_password_tmp."', '".$encrypted_administration_key_tmp."')");
  if (!$try_to_register_credentials_result) {
    $listmanager->close();
    error_alert($connect, "failed to register credentials : ".$connect->errno);
  }
  $try_to_register_basicdata_result = $connect->query("insert into userbasicdata (did, primaryaddress, secondaryaddress, city, state, province, postnum, phonenumber, emailaddress, extra) values(NULL, '".$primary_address."', '".$secondary_address."', '".$city."', '".$state."', '".$provice."', '".$postcode."', '".$phonenumber."', '".$emailaddress."', null)");
  if (!$try_to_register_basicdata_result) {
    $listmanager->close();
    error_alert($connect, "failed to register basic data : ".$connect->errno);
  }
  $try_to_add_cartlist_result = $listmanager->query("create table ".$username."_cartlist (cid int(5) not null auto_increment primary key,itemcode varchar(10) not null,itemqty int(5) not null,status int(1) not null default 1)");
  if (!$try_to_add_cartlist_result) {
    $listmanager->close();
    error_alert($connect, "Failed to initialize usercartlist table : ".$listmanager->errno);
  }
  $listmanager->close();
  $connect->close();
  return [
    'username_valid' => true,
    'password_valid' => true,
    'email_valid' => true
  ];
}
function add_to_cart(mysqli $connect, mysqli $listmanager, $server_url, $product_code, $amount) {
  $retrieve_product_result = $connect->query("select * from producttable where productcode='".$product_code."'");
  if (empty($retrieve_product_result->num_rows)) {
    $listmanager->close();
    error_alert($connect, "Product does not exists.");
  }
  $product_row = $retrieve_product_result->fetch_assoc();
  if ($product_row['productqty'] < $amount) {
    $listmanager->close();
    log_alert($connect, "Order amount is higher than quatity in stock.");
    return false;
  }
  if (session_restore_result($connect, $server_url)['session_valid']) {
    $look_for_existing_product_result = $listmanager->query("select * from ".$_COOKIE['current_userid']."_cartlist where itemcode='".$product_code."' and status=1");
    if ($look_for_existing_product_result->num_rows == 1) {
      $cart_row = $look_for_existing_product_result->fetch_assoc();
      $add_to_cart_result = $listmanager->query("update ".$_COOKIE['current_userid']."_cartlist set itemqty=".($cart_row['itemqty'] + $amount)." where itemcode='".$product_code."' and status=1");
      if (!$add_to_cart_result) {
        $listmanager->close();
        error_alert($connect, "Failed to add to cart at section 1 : ".$listmanager->errno);
      }
      $connect->close();
      $listmanager->close();
      return true;
    } else {
      $add_to_cart_result = $listmanager->query("insert to ".$_COOKIE['current_userid']."_cartlist (cid, itemcode, itemqty) values(NULL, '".$product_code."', ".$amount.")");
      if (!$add_to_cart_result) {
        $listmanager->close();
        error_alert($connect, "Failed to add to cart at section 2 : ".$listmanager->errno);
      }
      $listmanager->close();
      $connect->close();
      return true;
    }
  } else {
    $listmanager->close();
    log_alert($connect, "Session restore failed at add_to_cart function.");
    return false;
  }
}
function remove_from_cart(mysqli $connect, mysqli $listmanager, $server_url, $product_code, $amount) {
  if (session_restore_result($connect, $server_url)['session_valid']) {
    $retrieve_user_cartlist_result = $listmanager->query("select * from ".$_COOKIE['current_userid']."_cartlist where itemcode='".$product_code."' and status=1");
    if ($retrieve_user_cartlist_result->num_rows != 1) {
      $listmanager->close();
      error_alert($connect, "Incorrect amount of reported cartitem.");
    }
    $cart_row = $retrieve_user_cartlist_result->fetch_assoc();
    if ($amount > $cart_row['itemqty']) {
      $listmanager->close();
      error_alert($connect, "Removal amount is higher than the one in cartlist.");
    } else if ($amount == $cart_row['itemqty']) {
      $deletion_result = $listmanager->query("update ".$_COOKIE['current_userid']."_cartlist set status=0 where itemcode='".$product_code."' and status=1");
      if (!$deletion_result) {
        $listmanager->close();
        error_alert($connect, "Failed to disable cartlist error code : ".$listmanager->errno);
      }
      $listmanager->close();
      log_alert($connect, "Sucessfully remove your cartitem.");
      return true;
    } else {
      $reduction_result = $listmanager->query("update ".$_COOKIE['current_userid']."_cartlist set itemqty=".($cart_row['itemqty'] - $amount)." where itemcode='".$product_code."' and status=1");
      if (!$reduction_result) {
        $listmanager->close();
        error_alert($connect, "Failed to reduce from cartlist.");
      }
      $listmanager->close();
      log_alert($connect, "Sucessfully reduce your cartitem.");
      return true;
    }
  } else {
    $listmanager->close();
    log_alert($connect, "Session restore failed at remove_from_cart function.");
    return false;
  }
}
?>
