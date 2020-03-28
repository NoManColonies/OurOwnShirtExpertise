<!DOCTYPE html>
<html>
<head>
 <link type="text/css" rel="stylesheet"href="../css_comp/master.css">
	   <title>Home</title>
	   <meta charset="UTF-8">

</head>

<body>

<div class="head">
<ul>
  <li><a class="active" href="../index.php">หน้าหลัก</a></li>

  <li><a href="../about/about.php">เกี่ยวกับเรา</a></li>
  <li><a  href="../shirt/shirt.php">เสื้อนักศึกษา</a></li>
  <li><a  href="../sk/sk.php">กางเกง/กระโปรง</a></li>
  <li><a  href="../shoes/shoes.php">รองเท้านักศึกษา</a></li>
  <li><a  href="../other/other.php">อื่นๆ</a></li>
  <li style="float:right"><a  href="https://www.google.com/webhp?hl=th&sa=X&ved=0ahUKEwiHoOHqmbPoAhUTbn0KHRc2BsIQPAgH">ค้นหา</a></li>


  <li style="float:right"><a href="../contact/contact.php">ติดต่อเรา</a></li>
  <li style="float:right"><a class="active" href="login.php">เข้าสู่ระบบ</a></li>


  </ul>

  </div>
<?php session_start();?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Form Login</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
</head>
<body>

      <form name="frmlogin"  method="post" action="login_process.php">
        <p> </p>
        <p><b> Login Form </b></p>
        <p> ชื่อผู้ใช้ :
          <input type="text"   id="Username" required name="Username" placeholder="Username">
        </p>
        <p>รหัสผ่าน :
          <input type="password"   id="Password"required name="Password" placeholder="Password">
        </p>
        <p>
          <button type="submit">Login</button>
          &nbsp;&nbsp;
          <button type="reset">Reset</button>
          <br>
		  <a href="register.php">register</a>
        </p>
      </form>
</body>
</html>
</html>
