<?php
  $server = "localhost";
  $server_url = "worawanbydiistudent.store";
  $user = "";
  $password = "";
  $database = "";
  $connect = mysqli_connect($server, $user, $password);
  mysqli_select_db($connect, $database);
  if (!$connect) {
    die("connection timed out : fetal.");
  }
  session_start();
  /*
  function encrypt_hashkey($decrypted_hashkey_f) {
    return mysqli_query($connect, "SELECT AES_ENCRYPT($decrypted_hashkey_f, '')");
  }
  function decrypt_hashkey($encrypted_hashkey_f) {
    return mysqli_query($connect, "SELECT AES_DECRYPT($encrypted_hashkey_f, '')");
  }
  */
  function aes_encrypt($text) {
    $key = aes_key('');
    $pad_value = 16 - (strlen($text) % 16);
    $text = str_pad($text, (16 * (floor(strlen($text) / 16) + 1)), chr($pad_value));
    return mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $text, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB), MCRYPT_DEV_URANDOM));
  }
  function aes_decrypt($text) {
    $key = aes_key('');
    $text = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $text, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB), MCRYPT_DEV_URANDOM));
    return rtrim($text, "\0..\16");
  }
  function aes_key($key) {
    $new_key = str_repeat(chr(0), 16);
    for($i=0,$len=strlen($key);$i<$len;$i++) {
        $new_key[$i%16] = $new_key[$i%16] ^ $key[$i];
    }
    return $new_key;
  }
  function random_string($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_+=-~/?>.,<\|฿';
    $characters_length = strlen($characters);
    $random_string = '';
    for ($i = 0; $i < $length; $i++) {
      $random_string .= $characters[rand(0, $characters_length - 1)];
    }
    return $random_string;
  }
  function session_restore_result() {
    if(isset($_COOKIE['current_userid']) && $_COOKIE['current_userid'] != null && isset($_COOKIE['encrypted_hash_key']) && $_COOKIE['encrypted_hash_key'] != null && $_COOKIE['encrypted_administrationkey'] != null && isset($_COOKIE['encrypted_administrationkey'])) {
      $userid = $_COOKIE['current_userid'];
      $decrypted_hash_key = aes_decrypt($_COOKIE['encrypted_hash_key']);
      $server_decrypted_hash_key = mysqli_query($connect, "select * from usercredentials where userid='$userid'");
      if (mysqli_num_rows($server_decrypted_hash_key) == 0) {
        die("Could not detect user account from cookie. this shouldn't happen and should be checked before : fetal.");
      }
      $row = mysqli_fetch_assoc($server_decrypted_hash_key);
      if ($row['userhash_key'] == $decrypted_hash_key) {
        $random_string = random_string(50);
        $decrypted_hash_key = mysqli_query($connect, "password('$random_string')");
        $encrypted_hash_key = aes_encrypt($decrypted_hash_key);
        setcookie('encrypted_hash_key', $encrypted_hash_key, time() + 3600, '/', $server_url, false, true);
        setcookie('current_userid', $userid, time() + 3600, '/', $server_url, false, true);
        setcookie('encrypted_administrationkey', $row['useraccesskey'], time() + 3600, '/', $server_url, false, true);
        $hash_key_update_result = mysqli_query($connect, "update usercredentials set userhashkey='$decrypted_hash_key' where userid='$userid'");
        if (!$hash_key_update_result) {
          die("session restore failed : fetal.");
        }
        return true;
      } else {
        $hash_key_update_result = mysqli_query($connect, "update usercredentials set userhashkey=null where='$userid'");
        if (isset($_COOKIE['current_userid'])) {
          unset($_COOKIE['current_userid']);
        }
        if (isset($_COOKIE['encrypted_hash_key'])) {
          unset($_COOKIE['encrypted_hash_key']);
        }
        if (isset($_COOKIE['encrypted_administrationkey'])) {
          unset($_COOKIE['encrypted_administrationkey']);
        }
        if (!$hash_key_update_result) {
          die("destroy server hashkey failed. userid doesn't exists on server. this shouldn't occur as we already checked before : fetal.");
        }
        return false;
      }
    } else {
      if (isset($_COOKIE['current_userid'])) {
        unset($_COOKIE['current_userid']);
      }
      if (isset($_COOKIE['encrypted_hash_key'])) {
        unset($_COOKIE['encrypted_hash_key']);
      }
      if (isset($_COOKIE['encrypted_administrationkey'])) {
        unset($_COOKIE['encrypted_administrationkey']);
      }
      return false;
    }
  }
  function login_result($username, $vulnerable_password) {
    $encrypted_password_tmp = aes_encrypt($vulnerable_password);
    if ($username == null) {
      $try_to_get_passkey_tmp = 'keynotavailable';
    } else {
      $try_to_get_passkey_tmp = mysqli_query($connect, "select userpassword from usercredentials where userid='$username'");
    }
    if ($try_to_get_passkey_tmp == $encrypted_password_tmp) {
      $random_string = random_string(50);
      $decrypted_hash_key_tmp = mysqli_query($connect, "select password('$random_string')");
      $encrypted_hash_key_tmp = aes_encrypt($decrypted_hash_key_tmp);
      $encrypted_administration_key_tmp = mysqli_query($connect, "select useraccesskey from usercredentials where userid='$userid'");
      setcookie('encrypted_hash_key', $encrypted_hash_key_tmp, time() + 3600, '/', $server_url, false, true);
      setcookie('current_userid', $userid, time() + 3600, '/', $server_url, false, true);
      setcookie('encrypted_administrationkey', $encrypted_administration_key_tmp, time() + 3600, '/', $server_url, false, true);
      $hash_key_update_result = mysqli_query($connect, "update usercredentials set userhash_key='$decrypted_hash_key_tmp' where userid='$username'");
      if(!$hash_key_update_result) {
        unset($_COOKIE['encrypted_hash_key']);
        unset($_COOKIE['current_userid']);
        unset($_COOKIE['encrypted_administrationkey']);
        die("process failed during server hash_key update : fetal.");
      }
      return true;
    }
    return false;
  }
  function register_result($username, $vulnerable_password, $vulnerable_password_retype, $name, $lastname, $primary_address, $secondary_address, $city, $state, $provice, $postcode, $phonenumber, $emailaddress) {
    $server_userid_check = mysqli_query($connect, "select userid from usercredentials");
    while($row = mysqli_fetch_assoc($server_userid_check)) {
      if ($row == $username) {
        return ['username_valid' => false,
                'password_valid' => false,
                'email_valid' => false
        ];
      }
    }
    if ($vulnerable_password != $vulnerable_password_retype || $vulnerable_password == 'keynotavailable') {
      return ['username_valid' => true,
              'password_valid' => false,
              'email_valid' => false
      ];
    }
    $random_string = random_string(50);
    $encrypted_administration_key_tmp = mysqli_query($connect, "select password('$random_string')");
    $encrypted_password_tmp = aes_encrypt($vulnerable_password);
    $try_to_register_credentials_result = mysqli_query($connect, "insert into usercredentials ('uid', 'userid', 'username', 'userlastname', 'userpassword', 'userhashkey', 'useraccesskey', 'usercurrentip') values(null, '$username', '$name', '$lastname', '$encrypted_password_tmp', null, '$encrypted_administration_key_tmp', null)");
    if (!$try_to_register_credentials_result) {
      die("failed to register credentials : fetal.");
    }
    $try_to_register_basicdata_result = mysqli_query($connect, "insert into userbasicdata ('did', 'primaryaddress', 'secondaryaddress', 'city', 'state', 'province', 'postnum', 'phonenumber', 'emailaddress', 'extra') values(null, '$primary_address', '$secondary_address', '$city', '$state', '$provice', '$postcode', '$phonenumber', '$emailaddress', null)");
    if (!$try_to_register_basicdata_result) {
      die("failed to register basic data : fetal.");
    }
    return ['username_valid' => true,
            'password_valid' => true,
            'email_valid' => true
    ];
  }
?>
