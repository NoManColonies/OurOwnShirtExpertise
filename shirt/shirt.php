<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet"href="../css/master.css">
    <title>เสื้อนักศึกษา</title>
  </head>
  <body>
    <div class="head">
      <ul>
        <li><a href="../index.php"><i class="fas fa-home"></i>หน้าหลัก</a></li>
        <li><a href="../about/about.php"><i class="fas fa-building"></i>เกี่ยวกับเรา</a></li>
        <li><a class="active" href="../shirt/shirt.php"><i class="fas fa-tshirt"></i>เสื้อนักศึกษา</a></li>
        <li><a href="../sk/sk.php"><i class="fas fa-venus-mars"></i>กางเกง/กระโปรง</a></li>
        <li><a href="../shoes/shoes.php"><i class="fas fa-shoe-prints"></i>รองเท้านักศึกษา</a></li>
        <li><a href="../other/other.php"><i class="far fa-question-circle"></i>อื่นๆ</a></li>
        <li style="float:right"><a href="https://www.google.com/webhp?hl=th&sa=X&ved=0ahUKEwiHoOHqmbPoAhUTbn0KHRc2BsIQPAgH"><i class="fas fa-search"></i>ค้นหา</a></li>
        <li style="float:right"><a href="https://web.facebook.com/don.jirapipat?fref=gs&__tn__=%2CdlC-R-R&eid=ARD4Hn7n7y0YlNmiFkRA4pRC8wT9s0jqzBWc2Ffc5Hr4JDyBq0oFcob2oUzlIG2Per5K2EaVj0spOoBE&hc_ref=ARQT8XqV-z45u9iOFih8e6NeW5FfLPr1_UoW7itb2PfNVQr5SznweAP6t5DFePjomUw&ref=nf_target&dti=2510061589261957&hc_location=group&_rdc=1&_rdr"><i class="fas fa-address-book"></i>ติดต่อเรา</a></li>
        <?php
          require_once('../.confiq/confiq.php');
          if (session_restore_result($connect, $server_url)) {
            echo "<div class=\"dropdown\"><button class=\"dropbtn\"><i class=\"fas fa-user-shield\">บัญชี</button><div class=\"dropdown-content\"><a href=\"login/account.php\"><i class=\"fas fa-edit\"></i>แก้ไขข้อมูล</a><a href=\"login/transaction.php\"><i class=\"fas fa-clipboard-list\"></i>ประวัติการซื้อ</a><a href=\"login/logout.php\"><i class=\"fas fa-sign-out-alt\"></i>ออกจากระบบ</a></div></div>";
            $connect->close();
          } else {
            echo "<li style=\"float:right\"><a href=\"../login/login.php\"><i class=\"fas fa-sign-in-alt\"></i>เข้าสู่ระบบ</a></li>";
            $connect->close();
          }
        ?>      </ul>
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
      <h1><p>Items</p></h1>
      <form class="" action="" method="post">
        <div class="img">
          <a href="buyfem1.html"a target="_blank">
            <img src="../pic/fem1.jpg" alt="fem1">
          </a>
          <div class="desc">
            <p>เสื้อนักศึกษาแขนสั้น<br>ผู้หญิง<br></p>
            <p style="float:left">฿250</p>
            <input style="float:right" type="submit" name="shirt1buy" value="Buy">
          </div>
        </div>
        <div class="img">
          <a href="buymen1.html"a target="_blank">
            <img src="../pic/men1.jpg" alt="men1">
          </a>
          <div class="desc">
            <p>เสื้อนักศึกษาแขนสั้น<br>ผู้ชาย<br></p>
            <p style="float:left">฿250</p>
            <input style="float:right" type="submit" name="shirt2buy" value="Buy">
          </div>
        </div>
        <div class="img">
          <a href="buymen2.html"a target="_blank">
            <img src="../pic/men2.jpg" alt="men2">
          </a>
          <div class="desc">
            <p>เสื้อนักศึกษาแขนยาว<br>ผู้ชาย<br></p>
            <p style="float:left">฿290</p>
            <input style="float:right" type="submit" name="shirt3buy" value="Buy">
          </div>
        </div>
      </form>
    </div>
  </body>
  <script src="https://kit.fontawesome.com/115266479a.js" crossorigin="anonymous"></script>
</html>
