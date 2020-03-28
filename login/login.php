<!doctype html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Form Login</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link type="text/css" rel="stylesheet"href="../css_comp/master.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  </head>
  <body>
    <?php
      require_once('.confiq/confiq.php');
    ?>
    <div class="head">
      <ul>
        <li><a href="../index.php">หน้าหลัก</a></li>
        <li><a href="../about/about.php">เกี่ยวกับเรา</a></li>
        <li><a href="../shirt/shirt.php">เสื้อนักศึกษา</a></li>
        <li><a href="../sk/sk.php">กางเกง/กระโปรง</a></li>
        <li><a href="../shoes/shoes.php">รองเท้านักศึกษา</a></li>
        <li><a href="../other/other.php">อื่นๆ</a></li>
        <li style="float:right"><a href="https://www.google.com/webhp?hl=th&sa=X&ved=0ahUKEwiHoOHqmbPoAhUTbn0KHRc2BsIQPAgH">ค้นหา</a></li>
        <li style="float:right"><a href="../contact/contact.php">ติดต่อเรา</a></li>
        <li style="float:right"><a class="active" href="login.php">เข้าสู่ระบบ</a></li>
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
      <form name="login_form"  method="post" action="login_process.php">
        <p><b>Login Form</b></p>
        <label for="Username">ชื่อผู้ใช้ : </label>
        <input type="text"   id="Username" required name="Username" placeholder="Username">
        <label for="Password">รหัสผ่าน : </label>
        <input type="password"   id="Password" required name="Password" placeholder="Password">
        <input type="submit" name="" value="submit">
        <input type="reset" name="" value="reset">
        <a href="register.php">register</a>
      </form>
    </div>
  </body>
</html>
