<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet"href="css/master.css">
    <title>Home</title>
  </head>
  <body>
    <div class="grid__container">
      <div class="flex__container__left">
        <a class="active" href="index.php"><i class="fas fa-home"></i>หน้าหลัก</a>
        <a href="about/about.php"><i class="fas fa-building"></i>เกี่ยวกับเรา</a>
        <a href="shirt/shirt.php"><i class="fas fa-tshirt"></i>เสื้อนักศึกษา</a>
        <a href="sk/sk.php"><i class="fas fa-venus-mars"></i>กางเกง/กระโปรง</a>
        <a href="shoes/shoes.php"><i class="fas fa-shoe-prints"></i>รองเท้านักศึกษา</a>
        <a href="other/other.php"><i class="far fa-question-circle"></i>อื่นๆ</a>
      </div>
      <div class="flex__container__right">
        <a href="https://www.google.com/webhp?hl=th&sa=X&ved=0ahUKEwiHoOHqmbPoAhUTbn0KHRc2BsIQPAgH"><i class="fas fa-search"></i>ค้นหา</a>
        <?php
        require_once('.confiq/confiq.php');
        if (session_restore_result($connect, $server_url)) {
          echo "<div class=\"menu\"><div class=\"menu__btn\"><a href=\"#\"><i class=\"fas fa-user-shield\"></i>บัญชี</a></div><div class=\"smenu\"><a href=\"login/account.php\"><i class=\"fas fa-edit\"></i>แก้ไขข้อมูล</a><a href=\"login/transaction.php\"><i class=\"fas fa-clipboard-list\"></i>ประวัติการซื้อ</a><a href=\"login/logout.php\"><i class=\"fas fa-sign-out-alt\"></i>ออกจากระบบ</a></div></div>";
          $connect->close();
        } else {
          echo "<a href=\"login/login.php\"><i class=\"fas fa-sign-in-alt\"></i>เข้าสู่ระบบ</a>";
          $connect->close();
        }
        ?>
        <a href="https://web.facebook.com/don.jirapipat?fref=gs&__tn__=%2CdlC-R-R&eid=ARD4Hn7n7y0YlNmiFkRA4pRC8wT9s0jqzBWc2Ffc5Hr4JDyBq0oFcob2oUzlIG2Per5K2EaVj0spOoBE&hc_ref=ARQT8XqV-z45u9iOFih8e6NeW5FfLPr1_UoW7itb2PfNVQr5SznweAP6t5DFePjomUw&ref=nf_target&dti=2510061589261957&hc_location=group&_rdc=1&_rdr"><i class="fas fa-address-book"></i>ติดต่อเรา</a>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-xs-12">
          <div class="col-md-12 col-xs-12">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
              </ol>
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img class="d-block w-100" src="pic/head.png" alt="devbanban">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="pic/head1.jpg" alt="devbanban">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="pic/head2.png" alt="devbanban">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="pic/head3.png" alt="devbanban">
                </div>
              </div>
              <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
          </div>
        </div>
      </div>
      <h1><p>Items</p></h1>
      <form class="" action="index.html" method="post">
        <div class="img">
          <a href="buysh1.html"a target="_blank" >
            <img src="pic/sh1.jpg" alt="sh1" >
          </a>
          <div class="desc">
            <p>รองเท้าหุ้มส้นสีดำ<br>ผู้ชาย<br></p>
            <p style="float:left">฿450</p>
            <input style="float:right" type="submit" name="shoes1buy" value="Buy">
          </div>
        </div>
        <div class="img">
          <a href="buyfem1.html"a target="_blank" >
            <img src="pic/fem1.jpg" alt="fem1">
          </a>
          <div class="desc">
            <p>เสื้อนักศึกษาแขนสั้น<br>ผู้หญิง<br></p>
            <p style="float:left">฿250</p>
            <input style="float:right" type="submit" name="shirt1buy" value="Buy">
          </div>
        </div>
        <div class="img">
          <a href="buyfem2.html"a target="_blank" >
            <img src="pic/fem2.jpg" alt="fem2">
          </a>
          <div class="desc">
            <p>กระโปรงทรงเอ<br>ผู้หญิง<br></p>
            <p style="float:left">฿200</p>
            <input style="float:right" type="submit" name="sk1buy" value="Buy">
          </div>
        </div>
        <div class="img">
          <a href="buymen1.html"a target="_blank" >
            <img src="pic/men1.jpg" alt="men1">
          </a>
          <div class="desc">
            <p>เสื้อนักศึกษาแขนสั้น<br>ผู้ชาย<br></p>
            <p style="float:left">฿250</p>
            <input style="float:right" type="submit" name="shirt2buy" value="Buy">
          </div>
        </div>
        <div class="img">
          <a href="buymen2.html"a target="_blank" >
            <img src="pic/men2.jpg" alt="men2">
          </a>
          <div class="desc">
            <p>เสื้อนักศึกษาแขนยาว<br>ผู้ชาย<br></p>
            <p style="float:left">฿290</p>
            <input style="float:right" type="submit" name="shirt3buy" value="Buy">
          </div>
        </div>
        <div class="img">
          <a href="buymen3.html"a target="_blank" >
            <img src="pic/men3.jpg" alt="men3" >
          </a>
          <div class="desc">
            <p>กางเกงนักศึกษา<br>ผู้ชาย<br></p>
            <p style="float:left">฿280</p>
            <input style="float:right" type="submit" name="sk2buy" value="Buy">
          </div>
        </div>
        <div class="img">
          <a href="buysh2.html"a target="_blank" >
            <img src="pic/sh2.jpg" alt="sh2" >
          </a>
          <div class="desc">
            <p>รองเท้าผ้าใบสีขาว<br>ชาย/หญิง<br></p>
            <p style="float:left">฿250</p>
            <input style="float:right" type="submit" name="shoes2buy" value="Buy">
          </div>
        </div>
        <div class="img">
          <a href="buyfem3.html"a target="_blank" >
            <img src="pic/fem3.jpg" alt="fem3" >
          </a>
          <div class="desc">
            <p>กระโปรงพลีท<br>ผู้หญิง<br></p>
            <p style="float:left">฿280</p>
            <input style="float:right" type="submit" name="sk3buy" value="Buy">
          </div>
        </div>
        <div class="img">
          <a href="buysh3.html"a target="_blank" >
            <img src="pic/sh3.jpg" alt="sh3" >
          </a>
          <div class="desc">
            <p>รองเท้าคัทชู<br>ผู้หญิง<br></p>
            <p style="float:left">฿290</p>
            <input style="float:right" type="submit" name="shoes3buy" value="Buy">
          </div>
        </div>
        <div class="img">
          <a href="buyfem4.html"a target="_blank" >
            <img src="pic/fem4.jpg" alt="fem4" >
          </a>
          <div class="desc">
            <p>กระโปรงพิธีการ<br>ผู้หญิง<br></p>
            <p style="float:left">฿300</p>
            <input style="float:right" type="submit" name="sk4buy" value="Buy">
          </div>
        </div>
        <div class="img">
          <a href="buymen4.html"a target="_blank" >
            <img src="pic/men4.jpg" alt="men4" >
          </a>
          <div class="desc">
            <p>กางเกงพิธีการ<br>ผู้ชาย<br></p>
            <p style="float:left">฿300</p>
            <input style="float:right" type="submit" name="sk4buy" value="Buy">
          </div>
        </div>
      </form>
    </div>
    <center>
      <footer class="footer" style="margin-top: 50px"></footer>
    </center>
    <script src="https://kit.fontawesome.com/115266479a.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  </body>
</html>
