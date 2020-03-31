<?php
require_once('confiq.php');
$cartuser = "";
$cartuserpassword = "";
$cartuserdatabase = "";
$listmanager = new mysqli($server, $cartuser, $cartuserpassword, $cartuserdatabase);
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
  $try_to_add_cartlist_result = $listmanager->query("create table ".$username."_cartlist (cid int(5) not null auto_increment primary key,itemid int(5) not null,itemqty int(5) not null,status int(1) not null default 1)");
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
function add_to_cart(mysqli $connect, mysqli $listmanager, $server_url, $product_code) {
  $retrieve_product_result = $connect->query("select * from producttable where cid=".$product_code);
  if (empty($retrieve_product_result->num_rows)) {
    //product doesn't seem to exists on database, returning user back to home page.
    $listmanager->close();
    error_alert($connect, "Product does not exists.");
  }
  if (session_restore_result($connect, $server_url)['session_valid']) {
    $look_for_existing_product_result = $listmanager->query("select * from ".$_COOKIE['current_userid']."_cartlist where itemid=".$product_code);
    if ($look_for_existing_product_result->num_rows == 1) {
      $cart_row = $look_for_existing_product_result->fetch_assoc();
      if (!empty($cart_row['status'])) {
        $add_to_cart_result = $listmanager->query("update ".$_COOKIE['current_userid']."_cartlist set itemqty=".($cart_row['itemqty'] + 1)." where itemid='".$product_code."'");
        if (!$add_to_cart_result) {
          $listmanager->close();
          error_alert($connect, "Failed to add to cart at section 1 : ".$listmanager->errno);
        }
        $connect->close();
        $listmanager->close();
        return true;
      } else {
        $add_to_cart_result = $listmanager->query("insert to ".$_COOKIE['current_userid']."_cartlist (cid, itemid, itemqty) values(NULL, ".$product_code.", 1)");
        if (!$add_to_cart_result) {
          $listmanager->close();
          error_alert($connect, "Failed to add to cart at section 2 : ".$listmanager->errno);
        }
        $connect->close();
        $listmanager->close();
        return true;
      }
    } else if ($look_for_existing_product_result->num_rows > 1) {
      while ($cart_row = $look_for_existing_product_result->fetch_assoc()) {
        if (!empty($cart_row['status']) && $cart_row['itemid'] == $product_code) {
          $add_to_cart_result = $listmanager->query("update ".$_COOKIE['current_userid']."_cartlist set itemqty=".($cart_row['itemqty'] + 1)." where itemid=".$product_code.", status=1");
          if (!$add_to_cart_result) {
            $listmanager->close();
            error_alert($connect, "Failed to add to cart at section 3 : ".$listmanager->errno);
          }
          $connect->close();
          $listmanager->close();
          return true;
        } else {
          $procedure_done = false;
        }
      }
      if (!$procedure_done) {
        $add_to_cart_result = $listmanager->query("insert to ".$_COOKIE['current_userid']."_cartlist (cid, itemid, itemqty) values(NULL, ".$product_code.", 1)");
        if (!$add_to_cart_result) {
          $listmanager->close();
          error_alert($connect, "Failed to add to cart at section 4 : ".$listmanager->errno);
        }
        $connect->close();
        $listmanager->close();
        return true;
      }
    } else {
      $add_to_cart_result = $listmanager->query("insert to ".$_COOKIE['current_userid']."_cartlist (cid, itemid, itemqty) values(NULL, ".$product_code.", 1)");
      if (!$add_to_cart_result) {
        $listmanager->close();
        error_alert($connect, "Failed to add to cart at section 5 : ".$listmanager->errno);
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
function remove_from_cart(mysqli $connect, mysqli $listmanager, $server_url, $product_code) {
  if (session_restore_result($connect, $server_url)['session_valid']) {
    $deletion_result = $listmanager->query("update ".$_COOKIE['current_userid']."_cartlist set status=0 where itemid=".$product_code.", status=1");
    if (!$deletion_result) {
      $listmanager->close();
      log_alert($connect, "Failed to remove item from your cart : ".$listmanager->errno);
      return false;
    }
    $listmanager->close();
    log_alert($connect, "Sucessfully remove your cartitem.");
    return true;
  } else {
    $listmanager->close();
    log_alert($connect, "Session restore failed at remove_from_cart function.");
    return false;
  }
}
?>
