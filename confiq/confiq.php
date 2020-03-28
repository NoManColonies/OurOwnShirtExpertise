<?php
  $server = "localhost";
  $server_url = "worawanbydiistudent.store";
  $user = "";
  $password = "";
  $database = "";
  $connect = mysqli_connect($server, $user, $password, $database);
  if (!$connect) {
    die("connection timed out : fatal.");
  }
  function encrypt_hashkey($decryptedhashkey_f) {
    return mysqli_query($connect, "AES_ENCRYPT($decryptedhashkey_f, '')");
  }
  function decrypt_hashkey($encryptedhashkey_f) {
    return mysqli_query($connect, "AES_DECRYPT($encryptedhashkey_f, '')");
  }
  function random_string($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_+=-~/?>.,<\|฿';
    $charactersLength = strlen($characters);
    $letterassigned = false;
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }
  function sessionrestoreresult() {
    session_start();
    if(isset($_COOKIE['current_userid']) && $_COOKIE['current_userid'] != null && isset($_COOKIE['encrypted_hashkey']) && $_COOKIE['encrypted_hashkey'] != null && $_COOKIE['$encryptedadministrationkey'] != null && isset($_COOKIE['$encryptedadministrationkey'])) {
      $userid = $_COOKIE['current_userid'];
      $decryptedhashkey = decrypt_hashkey($_COOKIE['encrypted_hashkey']);
      $serverdecryptedhashkey = mysqli_query($connect, "select * from usercredentials where userid='$userid'");
      if ($serverdecryptedhashkey == 0) {
        die("Could not detect user account from cookie. this shouldn't happen and should be checked before : fatal.");
      }
      $row = mysqli_fetch_assoc($serverdecryptedhashkey);
      if ($row['userhashkey'] == $decryptedhashkey) {
        $randomstring = random_string(50);
        $decryptedhashkey = mysqli_query($connect, "password('$randomstring')");
        $encryptedhashkey = encrypt_hashkey($decryptedhashkey);
        set_cookie('encrypted_hashkey', $encryptedhashkey, time() + 3600, '/', $server_url, false);
        set_cookie('current_userid', $userid, time() + 3600, '/', $server_url, false);
        set_cookie('$encryptedadministrationkey', $row['useraccesskey'], time() + 3600, '/', $server_url, false);
        $sessionrestoreresult = mysqli_query($connect, "update usercredentials set userhashkey='$decryptedhashkey' where userid='$userid'");
        if (!$sessionrestoreresult) {
          die("session restore failed : fatal.");
        }
        return true;
      } else {
        //set_cookie('encrypted_hashkey', null, time() + 3600, '/', $server_url, false);
        $sessionrestoreresult = mysqli_query($connect, "update usercredentials set userhashkey=null where='$userid'");
        //set_cookie('current_userid', null, time() + 3600, '/', $server_url, false);
        if (!$sessionrestoreresult) {
          die("destroy server hashkey failed. userid doesn't exists on server. this shouldn't occur as we already checked before : fatal.");
        }
        return false;
      }
    } else {
      return false;
    }
  }
  function login($username, $vulnerable_password) {
    $encryptedpassword_tmp = encrypt_hashkey($vulnerable_password);
    $trytogetpasskey_tmp = mysqli_query($connect, "select userpassword from usercredentials where userid='$username'");
    if ($trytogetpasskey == $encryptedpassword) {
      $randomstring = random_string(50);
      $decryptedhashkey_tmp = mysqli_query("password('$randomstring')");
      $encryptedhashkey_tmp = encrypt_hashkey($decryptedhashkey_tmp);
      set_cookie('encrypted_hashkey', $encryptedhashkey_tmp, time() + 3600, '/', $server_url, false);
      set_cookie('current_userid', $userid, time() + 3600, '/', $server_url, false);
      $hashkeyupdateresult = mysqli_query($connect, "update usercredentials set userhashkey='$decryptedhashkey_tmp' where userid='$username'");
      if(!$hashkeyupdateresult) {
        die("process failed during server hashkey update : fatal.");
      }
      return true;
    }
    return false;
  }
  function register($username, $vulnerable_password, $name, $lastname) {
    $serveruseridcheck = mysqli_query($connect, "select userid from usercredentials");
    while($row = mysqli_fetch_assoc($serveruseridcheck)) {
      if ($row == $username) {
        return false;
      }
    }
    $randomstring = random_string(50);
    $encryptedadministrationkey_tmp = mysqli_query($connect, "password('$randomstring')");
    $encryptedpassword_tmp = encrypt_hashkey($vulnerable_password);
    $trytoregisterresult = mysqli_query($connect, "insert into usercredentials ('uid', 'userid', 'username', 'userlastname', 'userpassword', 'userhashkey', 'useraccesskey', 'usercurrentip') values(null, '$username', '$name', '$lastname', '$encryptedpassword_tmp', null, '$encryptedadministrationkey_tmp', null)");
    if (!$trytoregisterresult) {
      die("failed to register : fatal.");
    }
    return true;
  }
?>
