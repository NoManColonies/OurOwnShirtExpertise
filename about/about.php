<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet"href="../css_comp/master.css">
    <title>เกี่ยวกับเรา</title>
  </head>
  <body>
    <div class="head">
      <ul>
        <li><a  href="../index.php">หน้าหลัก</a></li>
        <li><a class="active" href="about.php">เกี่ยวกับเรา</a></li>
        <li><a  href="../shirt/shirt.php">เสื้อนักศึกษา</a></li>
        <li><a  href="../sk/sk.php">กางเกง/กระโปรง</a></li>
        <li><a  href="../shoes/shoes.php">รองเท้านักศึกษา</a></li>
        <li><a  href="../other/other.php">อื่นๆ</a></li>
        <li style="float:right"><a  href="https://www.google.com/webhp?hl=th&sa=X&ved=0ahUKEwiHoOHqmbPoAhUTbn0KHRc2BsIQPAgH">ค้นหา</a></li>
        <li style="float:right"><a href="../contact/contact.php">ติดต่อเรา</a></li>
        <?php
          require_once('../.confiq/confiq.php');
          if (session_restore_result($connect)) {
            mysqli_close($connect);
            echo "<li style=\"float:right\"><a href=\"../login/account.php\">บัญชี</a></li>";
            echo "<li style=\"float:right\"><a href=\"../login/logout.php\">ออกจากระบบ</a></li>";
          } else {
            echo "<li style=\"float:right\"><a href=\"../login/login.php\">เข้าสู่ระบบ</a></li>";
            mysqli_close($connect);
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
      <div class ="about">
        <h4><p>เกี่ยวกับเรา</p></h4>
        <p>DII สมรศรีวรวรรณ shop(DII วรวรรณ) เติบโตมาจากการทำโครงงานวิชา 960141 ซึ่งเป็นวิชาเกี่ยวกับการพัฒนา ทักษะด้านการใช้ภาษา html,css,php และการพัฒนา Database<br>ซึ่งงานชิ้นนี้เป็นการนำความรู้จากในห้องเรียนมาประยุกต์สร้างขึ้นเป็นการสร้าง Website ขึ้นมา 1 เว็บ</p>
        <p>เนื่องด้วยช่วงนี้ใกล้ถึงเวลาที่ เด็กนักเรียนผู้ซึ่งเพิ่งจบม.6ต้องเข้าเรียนในมหาวิทยาลัย บวกกับเกิดโรคระบาด COVID-19 ขึ้น จึงทำให้ไม่สะดวกต่อการออกไปสำรวจสอบถามลูกค้าโดยตรง ทางผู้จัดการร้านจึงตัดสินใจจัดทำ<br>ร้านขายอุปกรณ์ชุดนักศึกษาแบบออนไลน์เพื่อตอบสนองต่อความต้องการของลูกค้าซึ่งอาจมีในอนาคต</p>
        <p> DII Samornsriworawan shop(DII Worawan) grew up from 960141 class project that learn about  html, css, php, and<br>Database development.This project is to apply knowledge from the classroom to create a website. </p>
        <p>Due to this time,students who have just finished high school year 6 must attend university and<br>with the outbreak of COVID-19, which makes it inconvenient to go to inquire directly with customers The store manager decided to create<br>the online store sells student uniforms to meet the needs of customers that may be available in the future.</p>
      </div>
    </div>
  </body>
</html>
