<!doctype html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Form Login</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link type="text/css" rel="stylesheet"href="../css/master.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  </head>
  <body>
    <?php
      require_once('../.confiq/confiq.php');
      if (session_restore_result($connect, $server_url)) {
        $connect->close();
        header("Location: https://worawanbydiistudent.store/index.php");
      }
      if ((!is_null($_REQUEST['Username']) || !is_null($_REQUEST['Password'])) && !isset($_COOKIE['current_userid']) && !isset($_COOKIE['encrypted_hash_key'])) {
        if (!login_result($connect, $server_url, $_REQUEST['Username'], $_REQUEST['Password'])) {
          echo "<script type=\"text/javascript\">";
          echo "console.log(\"username or password does not match\");";
          echo "</script>";
          $connect->close();
          header("Location: https://worawanbydiistudent.store/login/login.php");
        } else {
          $connect->close();
          header("Location: https://worawanbydiistudent.store/index.php");
        }
      } else {
        $connect->close();
      }
    ?>
    <div class="grid__container">
      <div class="flex__container__left">
        <a href="../index.php"><i class="fas fa-home"></i>หน้าหลัก</a>
        <a href="../about/about.php"><i class="fas fa-building"></i>เกี่ยวกับเรา</a>
        <a href="../shirt/shirt.php"><i class="fas fa-tshirt"></i>เสื้อนักศึกษา</a>
        <a href="../sk/sk.php"><i class="fas fa-venus-mars"></i>กางเกง/กระโปรง</a>
        <a href="../shoes/shoes.php"><i class="fas fa-shoe-prints"></i>รองเท้านักศึกษา</a>
        <a href="../other/other.php"><i class="far fa-question-circle"></i>อื่นๆ</a>
      </div>
      <div class="flex__container__right">
        <a href="https://www.google.com/webhp?hl=th&sa=X&ved=0ahUKEwiHoOHqmbPoAhUTbn0KHRc2BsIQPAgH"><i class="fas fa-search"></i>ค้นหา</a>
        <a class="active" href="login/login.php"><i class="fas fa-sign-in-alt"></i>เข้าสู่ระบบ</a>
        <a href="https://web.facebook.com/don.jirapipat?fref=gs&__tn__=%2CdlC-R-R&eid=ARD4Hn7n7y0YlNmiFkRA4pRC8wT9s0jqzBWc2Ffc5Hr4JDyBq0oFcob2oUzlIG2Per5K2EaVj0spOoBE&hc_ref=ARQT8XqV-z45u9iOFih8e6NeW5FfLPr1_UoW7itb2PfNVQr5SznweAP6t5DFePjomUw&ref=nf_target&dti=2510061589261957&hc_location=group&_rdc=1&_rdr"><i class="fas fa-address-book"></i>ติดต่อเรา</a>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-xs-12">
          <nav class="navbar navbar-expand-lg navbar-light bg-light"></nav>
          <div class="col-md-12 col-xs-12">
            <img class="d-block w-100" src="../pic/head4.png" alt="devbanban">
          </div>
        </div>
      </div>
      <form name="login_form"  method="post" action="login.php">
        <p><b>Login Form</b></p>
        <label for="Username">ชื่อผู้ใช้ : </label>
        <input type="text" id="Username" required name="Username" placeholder="Username">
        <label for="Password">รหัสผ่าน : </label>
        <input type="password" id="Password" required name="Password" placeholder="Password">
        <input type="submit" name="" value="Login">
        <input type="reset" name="" value="Clear">
        <a href="register.php">register</a>
      </form>
    </div>
  </body>
  <script src="https://kit.fontawesome.com/115266479a.js" crossorigin="anonymous"></script>
</html>
