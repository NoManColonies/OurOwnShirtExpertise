<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet"href="../css/master.css">
    <title>เกี่ยวกับเรา</title>
  </head>
  <body>
    <div class="grid__container">
      <div class="flex__container__left">
        <a href="../index.php"><i class="fas fa-home"></i>หน้าหลัก</a>
        <a class="active" href="../about/about.php"><i class="fas fa-building"></i>เกี่ยวกับเรา</a>
        <a href="../shirt/shirt.php"><i class="fas fa-tshirt"></i>เสื้อนักศึกษา</a>
        <a href="../sk/sk.php"><i class="fas fa-venus-mars"></i>กางเกง/กระโปรง</a>
        <a href="../shoes/shoes.php"><i class="fas fa-shoe-prints"></i>รองเท้านักศึกษา</a>
        <a href="../other/other.php"><i class="far fa-question-circle"></i>อื่นๆ</a>
      </div>
      <div class="flex__container__right">
        <a href="https://www.google.com/webhp?hl=th&sa=X&ved=0ahUKEwiHoOHqmbPoAhUTbn0KHRc2BsIQPAgH"><i class="fas fa-search"></i>ค้นหา</a>
        <?php
        require_once('../.confiq/confiq.php');
        $session = session_auth_check($connect, $server_url);
        if ($session['session_valid']) {
          if ($session['auth_key_valid']) {
            echo "<div class=\"menu\"><div class=\"menu__btn\"><a href=\"#\"><i class=\"fas fa-user-shield\"></i>บัญชี</a></div><div class=\"smenu\"><a href=\"../authorities/product_add.php\"><i class=\"fas fa-user-shield\"></i>เพิ่มสินค้า</a><a href=\"../login/logout.php\"><i class=\"fas fa-sign-out-alt\"></i>ออกจากระบบ</a></div></div>";
          } else {
            echo "<div class=\"menu\"><div class=\"menu__btn\"><a href=\"#\"><i class=\"fas fa-user-shield\"></i>บัญชี</a></div><div class=\"smenu\"><a href=\"../login/usercart.php\"><i class=\"fas fa-shopping-cart\"></i>ตระกร้าสินค้า</a><a href=\"../login/transaction.php\"><i class=\"fas fa-clipboard-list\"></i>ประวัติการซื้อ</a><a href=\"../login/account.php\"><i class=\"fas fa-edit\"></i>แก้ไขข้อมูล</a><a href=\"../login/logout.php\"><i class=\"fas fa-sign-out-alt\"></i>ออกจากระบบ</a></div></div>";
          }
        } else {
          echo "<a href=\"../login/usercart.php\"><i class=\"fas fa-shopping-cart\"></i>ตระกร้าสินค้า</a><a href=\"../login/login.php\"><i class=\"fas fa-sign-in-alt\"></i>เข้าสู่ระบบ</a>";
        }
        $connect->close();
        ?>
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
      <div class ="about">
        <h4><p>เกี่ยวกับเรา</p></h4>
        <p>DII สมรศรีวรวรรณ shop(DII วรวรรณ) เติบโตมาจากการทำโครงงานวิชา 960141 ซึ่งเป็นวิชาเกี่ยวกับการพัฒนา ทักษะด้านการใช้ภาษา html,css,php และการพัฒนา Database<br>ซึ่งงานชิ้นนี้เป็นการนำความรู้จากในห้องเรียนมาประยุกต์สร้างขึ้นเป็นการสร้าง Website ขึ้นมา 1 เว็บ</p>
        <p>เนื่องด้วยช่วงนี้ใกล้ถึงเวลาที่ เด็กนักเรียนผู้ซึ่งเพิ่งจบม.6ต้องเข้าเรียนในมหาวิทยาลัย บวกกับเกิดโรคระบาด COVID-19 ขึ้น จึงทำให้ไม่สะดวกต่อการออกไปสำรวจสอบถามลูกค้าโดยตรง ทางผู้จัดการร้านจึงตัดสินใจจัดทำ<br>ร้านขายอุปกรณ์ชุดนักศึกษาแบบออนไลน์เพื่อตอบสนองต่อความต้องการของลูกค้าซึ่งอาจมีในอนาคต</p>
        <p> DII Samornsriworawan shop(DII Worawan) grew up from 960141 class project that learn about  html, css, php, and<br>Database development.This project is to apply knowledge from the classroom to create a website. </p>
        <p>Due to this time,students who have just finished high school year 6 must attend university and<br>with the outbreak of COVID-19, which makes it inconvenient to go to inquire directly with customers The store manager decided to create<br>the online store sells student uniforms to meet the needs of customers that may be available in the future.</p>
      </div>
    </div>
  </body>
  <script src="https://kit.fontawesome.com/115266479a.js" crossorigin="anonymous"></script>
</html>
