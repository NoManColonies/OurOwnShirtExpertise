<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet"href="../css/master.css">
   	<title>กางเกง/กระโปรง</title>
  </head>
  <body>
    <div class="head">
    <ul>
      <li><a  href="../index.php">หน้าหลัก</a></li>
      <li><a  href="../about/about.php">เกี่ยวกับเรา</a></li>
      <li><a   href="../shirt/shirt.php">เสื้อนักศึกษา</a></li>
      <li><a  class="active" href="sk.php">กางเกง/กระโปรง</a></li>
      <li><a  href="../shoes/shoes.php">รองเท้านักศึกษา</a></li>
      <li><a  href="../other/other.php">อื่นๆ</a></li>
      <li style="float:right"><a  href="https://www.google.com/webhp?hl=th&sa=X&ved=0ahUKEwiHoOHqmbPoAhUTbn0KHRc2BsIQPAgH">ค้นหา</a></li>
      <li style="float:right"><a href="../contact/contact.php">ติดต่อเรา</a></li>
      <?php
        require_once('../.confiq/confiq.php');
        if (session_restore_result($connect, $server_url)) {
          $connect->close();
          echo "<li style=\"float:right\"><a href=\"../login/account.php\">บัญชี</a></li>";
          echo "<li style=\"float:right\"><a href=\"../login/logout.php\">ออกจากระบบ</a></li>";
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
      <h1><p>Items</p></h1>
      <form class="" action="" method="post">
        <div class="img">
          <a href="buyfem2.html"a target="_blank" >
            <img src="../pic/fem2.jpg" alt="fem2">
          </a>
          <div class="desc">
            <p>กระโปรงทรงเอ<br>ผู้หญิง<br></p>
            <p style="float:left">฿200</p>
            <input style="float:right" type="submit" name="sk1buy" value="Buy">
          </div>
        </div>
        <div class="img">
          <a href="buymen3.html"a target="_blank" >
            <img src="../pic/men3.jpg" alt="men3" >
          </a>
          <div class="desc">
            <p>กางเกงนักศึกษา<br>ผู้ชาย<br></p>
            <p style="float:left">฿280</p>
            <input style="float:right" type="submit" name="sk2buy" value="Buy">
          </div>
        </div>
        <div class="img">
          <a href="buyfem4.html"a target="_blank" >
            <img src="../pic/fem4.jpg" alt="fem4" >
          </a>
          <div class="desc">
            <p>กระโปรงพิธีการ<br>ผู้หญิง<br></p>
            <p style="float:left">฿300</p>
            <input style="float:right" type="submit" name="sk3buy" value="Buy">
          </div>
        </div>
        <div class="img">
          <a href="buymen4.html"a target="_blank" >
            <img src="../pic/men4.jpg" alt="men4" >
          </a>
          <div class="desc">
            <p>กางเกงพิธีการ<br>ผู้ชาย<br></p>
            <p style="float:left">฿300</p>
            <input style="float:right" type="submit" name="sk4buy" value="Buy">
          </div>
        </div>
        <div class="img">
          <a href="buyfem3.html"a target="_blank" >
            <img src="../pic/fem3.jpg" alt="fem3" >
          </a>
          <div class="desc">
            <p>กระโปรงพลีท<br>ผู้หญิง<br></p>
            <p style="float:left">฿280</p>
            <input style="float:right" type="submit" name="sk3buy" value="Buy">
          </div>
        </div>
      </form>
    </div>
  </body>
</html>
