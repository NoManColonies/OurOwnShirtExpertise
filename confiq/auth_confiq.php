<?php
require_once('confiq.php');
$cartuser = "";
$cartuserpassword = "";
$cartuserdatabase = "";
$listmanager = new mysqli($server, $cartuser, $cartuserpassword, $cartuserdatabase);
if (!$listmanager) {
  alert_message("Connection timed out for user : ".$cartuser." error code : ".$listmanager->errno);
  exit();
}
function register_result(mysqli $connect, mysqli $listmanager, $username, $vulnerable_password, $vulnerable_password_retype, $name, $lastname, $primary_address, $secondary_address, $city, $state, $provice, $postcode, $phonenumber, $emailaddress) {
  $server_userid_check = $connect->query("select * from usercredentials");
  while($row = $server_userid_check->fetch_assoc()) {
    if ($row['userid'] == $username) {
      $listmanager->close();
      $connect->close();
      return [
        'username_valid' => false,
        'password_valid' => false,
        'email_valid' => false
      ];
    }
  }
  if ($vulnerable_password != $vulnerable_password_retype || $vulnerable_password == 'keynotavailable' || is_null($vulnerable_password)) {
    $listmanager->close();
    $connect->close();
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
    error_alert($connect, "Failed to register credentials. error code : ".$connect->errno);
  }
  $try_to_register_basicdata_result = $connect->query("insert into userbasicdata (did, primaryaddress, secondaryaddress, city, state, province, postnum, phonenumber, emailaddress, extra) values(NULL, '".$primary_address."', '".$secondary_address."', '".$city."', '".$state."', '".$provice."', '".$postcode."', '".$phonenumber."', '".$emailaddress."', null)");
  if (!$try_to_register_basicdata_result) {
    $listmanager->close();
    error_alert($connect, "Failed to register basic data. error code : ".$connect->errno);
  }
  $try_to_add_cartlist_result = $listmanager->query("create table ".$username."_cartlist (cid int(5) not null auto_increment primary key,itemcode varchar(10) not null,itemqty int(5) not null,status int(1) not null default 1)");
  if (!$try_to_add_cartlist_result) {
    $listmanager->close();
    error_alert($connect, "Failed to initialize usercartlist table. error code : ".$listmanager->errno);
  }
  $listmanager->close();
  $connect->close();
  return [
    'username_valid' => true,
    'password_valid' => true,
    'email_valid' => true
  ];
}
function add_to_cart(mysqli $connect, mysqli $listmanager, $product_code, $amount, $update) {
  $retrieve_product_result = $connect->query("select * from producttable where productcode='".$product_code."'");
  if (empty($retrieve_product_result->num_rows)) {
    alert_message("Product does not exists.");
    return false;
  }
  $product_row = $retrieve_product_result->fetch_assoc();
  $session = session_restore_result($connect);
  if ($session['session_valid']) {
    $look_for_existing_product_result = $listmanager->query("select * from ".$_SESSION['current_userid']."_cartlist where itemcode='".$product_code."' and status=1");
    if ($look_for_existing_product_result->num_rows == 1) {
      $cart_row = $look_for_existing_product_result->fetch_assoc();
      if ($update) {
        if ($product_row['productqty'] < $amount + $cart_row['itemqty']) {
          alert_message("Order amount is higher than quatity in stock.");
          return false;
        }
        $add_to_cart_result = $listmanager->query("update ".$_SESSION['current_userid']."_cartlist set itemqty=".($cart_row['itemqty'] + $amount)." where itemcode='".$product_code."' and status=1");
      } else {
        if ($product_row['productqty'] < $amount) {
          alert_message("Order amount is higher than quatity in stock.");
          return false;
        }
        $add_to_cart_result = $listmanager->query("update ".$_SESSION['current_userid']."_cartlist set itemqty=".$amount." where itemcode='".$product_code."' and status=1");
      }
      if (!$add_to_cart_result) {
        alert_message("Failed to add to cart at section 1. error code : ".$listmanager->errno);
        return false;
      }
      return true;
    } else {
      if ($product_row['productqty'] < $amount) {
        alert_message("Order amount is higher than quatity in stock.");
        return false;
      }
      $add_to_cart_result = $listmanager->query("insert into ".$_SESSION['current_userid']."_cartlist (cid, itemcode, itemqty) values(NULL, '".$product_code."', ".$amount.")");
      if (!$add_to_cart_result) {
        alert_message("Failed to add to cart at section 2. error code : ".$listmanager->errno);
      }
      return true;
    }
  } else {
    alert_message("Session restore failed at add_to_cart function.");
    return false;
  }
}
function remove_from_cart(mysqli $connect, mysqli $listmanager, $product_code, $amount) {
  $session = session_restore_result($connect);
  if ($session['session_valid']) {
    $retrieve_user_cartlist_result = $listmanager->query("select * from ".$_SESSION['current_userid']."_cartlist where itemcode='".$product_code."' and status=1");
    if ($retrieve_user_cartlist_result->num_rows != 1) {
      alert_message("Incorrect amount of reported cartitem. found : ".$retrieve_user_cartlist_result->num_rows);
      return false;
    }
    $cart_row = $retrieve_user_cartlist_result->fetch_assoc();
    if ($amount > $cart_row['itemqty']) {
      alert_message("Removal amount is higher than the one in cartlist.");
      return false;
    } else if ($amount == $cart_row['itemqty']) {
      $deletion_result = $listmanager->query("update ".$_SESSION['current_userid']."_cartlist set status=0 where itemcode='".$product_code."' and status=1");
      if (!$deletion_result) {
        alert_message("Failed to disable cartlist. error code : ".$listmanager->errno);
        return false;
      }
      alert_message("Sucessfully remove your cartitem.");
      return true;
    } else {
      $reduction_result = $listmanager->query("update ".$_SESSION['current_userid']."_cartlist set itemqty=".($cart_row['itemqty'] - $amount)." where itemcode='".$product_code."' and status=1");
      if (!$reduction_result) {
        alert_message("Failed to reduce from cartlist. error code : ".$listmanager->errno);
        return false;
      }
      alert_message("Sucessfully reduce your cartitem.");
      return true;
    }
  } else {
    alert_message("Session restore failed at remove_from_cart function.");
    return false;
  }
}
?>
