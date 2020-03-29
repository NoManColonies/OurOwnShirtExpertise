<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet"href="../css/master.css">
    <title>อื่นๆ</title>
  </head>
  <body>
    <div class="head">
      <ul>
        <li><a  href="../index.php">หน้าหลัก</a></li>
        <li><a href="../about/about.php">เกี่ยวกับเรา</a></li>
        <li><a href="../shirt/shirt.php">เสื้อนักศึกษา</a></li>
        <li><a href="../sk/sk.php">กางเกง/กระโปรง</a></li>
        <li><a href="../shoes/shoes.php">รองเท้านักศึกษา</a></li>
        <li><a class="active" href="other.php">อื่นๆ</a></li>
        <li style="float:right"><a href="https://www.google.com/webhp?hl=th&sa=X&ved=0ahUKEwiHoOHqmbPoAhUTbn0KHRc2BsIQPAgH">ค้นหา</a></li>
        <li style="float:right"><a href="https://web.facebook.com/don.jirapipat?fref=gs&__tn__=%2CdlC-R-R&eid=ARD4Hn7n7y0YlNmiFkRA4pRC8wT9s0jqzBWc2Ffc5Hr4JDyBq0oFcob2oUzlIG2Per5K2EaVj0spOoBE&hc_ref=ARQT8XqV-z45u9iOFih8e6NeW5FfLPr1_UoW7itb2PfNVQr5SznweAP6t5DFePjomUw&ref=nf_target&dti=2510061589261957&hc_location=group&_rdc=1&_rdr">ติดต่อเรา</a></li>
        <?php
          require_once('../.confiq/confiq.php');
          if (session_restore_result($connect, $server_url)) {
            $connect->close();
            echo "<div class=\"dropdown\"><button class=\"dropbtn\">บัญชี</button><div class=\"dropdown-content\"><a href=\"../login/account.php\">แก้ไขข้อมูล</a><a href=\"../login/transaction.php\">ประวัติการซื้อ</a><a href=\"../login/logout.php\">ออกจากระบบ</a></div></div>";
          } else {
            echo "<li style=\"float:right\"><a href=\"../login/login.php\">เข้าสู่ระบบ</a></li>";
            $connect->close();
          }
        ?>
      </ul>
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
      <form class="" action="" method="post">
        <h1><p>Items</p></h1>
        <div class="img">
          <a href="buyother1.php"a target="_blank" >
            <img src="../pic/ot1.jpg" alt="ot1" >
          </a>
          <div class="desc">เนคไทด์นักศึกษา<br> มช.
            <br><p style="float:left">฿45000</p>
            <p style="float:right"><input type="submit" name="other1buy" value="Buy"></p>
          </div>
        </div>
        <div class="img">
          <a href="buyother2.php"a target="_blank" >
            <img src="../pic/ot2.jpg" alt="ot2" >
          </a>
          <div class="desc">เข็มกลัดนักศึกษา<br> มช.
            <br><p style="float:left">฿145000</p>
            <p style="float:right"><input type="submit" name="other2buy" value="Buy"></p>
          </div>
        </div>
        <div class="img">
          <a href="buyother3.php"a target="_blank" >
            <img src="../pic/ot3.jpg" alt="ot3" >
          </a>
          <div class="desc">หัวเข็มขัดนักศึกษา<br> มช.
            <br><p style="float:left">฿30000</p>
            <p style="float:right"><input type="submit" name="other3buy" value="Buy"></p>
          </div>
        </div>
        <div class="img">
          <a href="buyother4.php"a target="_blank" >
            <img src="../pic/ot4.jpg" alt="ot4" >
          </a>
          <div class="desc">กระดุมนักศึกษามช.<br> 5 เม็ด
            <br><p style="float:left">฿10000</p>
            <p style="float:right"><input type="submit" name="other4buy" value="Buy"></p>
          </div>
        </div>
        <div class="img">
          <a href="buyother5.php"a target="_blank" >
            <img src="../pic/ot5.jpg" alt="ot5" >
          </a>
          <div class="desc">ตุ้งติ้งนักศึกษา<br> มช.
            <br><p style="float:left">฿6000000</p>
            <p style="float:right"><input type="submit" name="other5buy" value="Buy"></p>
          </div>
        </div>
      </form>
    </div>
  </body>
</html>
