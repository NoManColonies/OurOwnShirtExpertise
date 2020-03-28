<?php
  $server = "localhost";
  $server_url = "worawanbydiistudent.store";
  $user = "";
  $password = "";
  $database = "";
  $connect = mysqli_connect($server, $user, $password, $database);
  if (!$connect) {
    die("connection timed out : fetal.");
  }
  session_start();
  function encrypt_hashkey($decryptedhashkey_f) {
    return mysqli_query($connect, "AES_ENCRYPT($decryptedhashkey_f, '')");
  }
  function decrypt_hashkey($encryptedhashkey_f) {
    return mysqli_query($connect, "AES_DECRYPT($encryptedhashkey_f, '')");
  }
  function random_string($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_+=-~/?>.,<\|฿';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }
  function session_restore_result() {
    if(isset($_COOKIE['current_userid']) && $_COOKIE['current_userid'] != null && isset($_COOKIE['encrypted_hashkey']) && $_COOKIE['encrypted_hashkey'] != null && $_COOKIE['encrypted_administrationkey'] != null && isset($_COOKIE['encrypted_administrationkey'])) {
      $userid = $_COOKIE['current_userid'];
      $decryptedhashkey = decrypt_hashkey($_COOKIE['encrypted_hashkey']);
      $serverdecryptedhashkey = mysqli_query($connect, "select * from usercredentials where userid='$userid'");
      if (mysqli_num_rows($serverdecryptedhashkey) == 0) {
        die("Could not detect user account from cookie. this shouldn't happen and should be checked before : fetal.");
      }
      $row = mysqli_fetch_assoc($serverdecryptedhashkey);
      if ($row['userhashkey'] == $decryptedhashkey) {
        $randomstring = random_string(50);
        $decryptedhashkey = mysqli_query($connect, "password('$randomstring')");
        $encryptedhashkey = encrypt_hashkey($decryptedhashkey);
        setcookie('encrypted_hashkey', $encryptedhashkey, time() + 3600, '/', $server_url, false, true);
        setcookie('current_userid', $userid, time() + 3600, '/', $server_url, false, true);
        setcookie('encrypted_administrationkey', $row['useraccesskey'], time() + 3600, '/', $server_url, false, true);
        $sessionrestoreresult = mysqli_query($connect, "update usercredentials set userhashkey='$decryptedhashkey' where userid='$userid'");
        if (!$sessionrestoreresult) {
          die("session restore failed : fetal.");
        }
        return true;
      } else {
        $sessionrestoreresult = mysqli_query($connect, "update usercredentials set userhashkey=null where='$userid'");
        if (isset($_COOKIE['current_userid'])) {
          unset($_COOKIE['current_userid']);
        }
        if (isset($_COOKIE['encrypted_hashkey'])) {
          unset($_COOKIE['encrypted_hashkey']);
        }
        if (isset($_COOKIE['encrypted_administrationkey'])) {
          unset($_COOKIE['encrypted_administrationkey']);
        }
        if (!$sessionrestoreresult) {
          die("destroy server hashkey failed. userid doesn't exists on server. this shouldn't occur as we already checked before : fetal.");
        }
        return false;
      }
    } else {
      if (isset($_COOKIE['current_userid'])) {
        unset($_COOKIE['current_userid']);
      }
      if (isset($_COOKIE['encrypted_hashkey'])) {
        unset($_COOKIE['encrypted_hashkey']);
      }
      if (isset($_COOKIE['encrypted_administrationkey'])) {
        unset($_COOKIE['encrypted_administrationkey']);
      }
      return false;
    }
  }
  function login_result($username, $vulnerable_password) {
    $encryptedpassword_tmp = encrypt_hashkey($vulnerable_password);
    $trytogetpasskey_tmp = mysqli_query($connect, "select userpassword from usercredentials where userid='$username'");
    if ($trytogetpasskey == $encryptedpassword && $trytogetpasskey_tmp != null) {
      $randomstring = random_string(50);
      $decryptedhashkey_tmp = mysqli_query("password('$randomstring')");
      $encryptedhashkey_tmp = encrypt_hashkey($decryptedhashkey_tmp);
      $encryptedadministrationkey_tmp = mysqli_query($connect, "select useraccesskey from usercredentials where userid='$userid'");
      setcookie('encrypted_hashkey', $encryptedhashkey_tmp, time() + 3600, '/', $server_url, false, true);
      setcookie('current_userid', $userid, time() + 3600, '/', $server_url, false, true);
      setcookie('encrypted_administrationkey', $encryptedadministrationkey_tmp, time() + 3600, '/', $server_url, false, true);
      $hashkeyupdateresult = mysqli_query($connect, "update usercredentials set userhashkey='$decryptedhashkey_tmp' where userid='$username'");
      if(!$hashkeyupdateresult) {
        unset($_COOKIE['encrypted_hashkey']);
        unset($_COOKIE['current_userid']);
        unset($_COOKIE['encrypted_administrationkey']);
        die("process failed during server hashkey update : fetal.");
      }
      return true;
    }
    return false;
  }
  function register_result($username, $vulnerable_password, $vulnerable_password_retype, $name, $lastname, $primaryaddress, $secondaryaddress, $city, $state, $provice, $postcode, $phonenumber, $emailaddress) {
    $serveruseridcheck = mysqli_query($connect, "select userid from usercredentials");
    while($row = mysqli_fetch_assoc($serveruseridcheck)) {
      if ($row == $username) {
        return ['username_valid' => false,
                'password_valid' => false,
                'email_valid' => false
        ];
      }
    }
    if ($vulnerable_password != $vulnerable_password_retype) {
      return ['username_valid' => true,
              'password_valid' => false,
              'email_valid' => false
      ];
    }
    $randomstring = random_string(50);
    $encryptedadministrationkey_tmp = mysqli_query($connect, "password('$randomstring')");
    $encryptedpassword_tmp = encrypt_hashkey($vulnerable_password);
    $trytoregistercredentialsresult = mysqli_query($connect, "insert into usercredentials ('uid', 'userid', 'username', 'userlastname', 'userpassword', 'userhashkey', 'useraccesskey', 'usercurrentip') values(null, '$username', '$name', '$lastname', '$encryptedpassword_tmp', null, '$encryptedadministrationkey_tmp', null)");
    if (!$trytoregistercredentialsresult) {
      die("failed to register credentials : fetal.");
    }
    $trytoregisterbasicdataresult = mysqli_query($connect, "insert into userbasicdata ('did', 'primaryaddress', 'secondaryaddress', 'city', 'state', 'province', 'postnum', 'phonenumber', 'emailaddress', 'extra') values(null, '$primaryaddress', '$secondaryaddress', '$city', '$state', '$provice', '$postcode', '$phonenumber', '$emailaddress', null)");
    if (!$trytoregisterbasicdataresult) {
      die("failed to register basic data : fetal.");
    }
    return ['username_valid' => true,
            'password_valid' => true,
            'email_valid' => true
    ];
  }
?>
