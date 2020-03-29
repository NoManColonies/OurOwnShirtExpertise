<?php
  require_once("../.confiq/confiq.php");
  $encrypted_administration_key_tmp = argon2_encrypt('');
  $update_access_key = $connect->query("update usercredentials set useraccesskey='".$encrypted_administration_key_tmp."' where userid='root'");
  if (!$update_access_key) {
    printf("Failed to update useraccesskey : [fetal]");
    exit();
  }
  printf("Useraccesskey was updated successfully.");
  $connect->close();
?>
