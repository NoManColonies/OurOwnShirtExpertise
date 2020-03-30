<!doctype html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Form Register</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link type="text/css" rel="stylesheet"href="../css/master.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<form name="registeration_form"  method="post" action="register.php">
  </head>
  <body>
    <?php
      require_once('../.confiq/confiq.php');
      if (session_restore_result($connect, $server_url)) {
        $connect->close();
        header("Location: https://worawanbydiistudent.store/index.php");
      }
      if ($_REQUEST['Username'] != null || $_REQUEST['Password'] != null) {
        $array_of_error_code = register_result($connect, $_REQUEST['Username'], $_REQUEST['Password'], $_REQUEST['Repassword'], $_REQUEST['Name'], $_REQUEST['Lastname'], $_REQUEST['Address1'], $_REQUEST['Address2'], $_REQUEST['City'], $_REQUEST['State'], $_REQUEST['Province'], $_REQUEST['Postcode'], $_REQUEST['Phone'], $_REQUEST['Email']);
        if (!$array_of_error_code['username_valid'] || !$array_of_error_code['password_valid']) {
          echo "<script type=\"text/javascript\">";
          echo "console.log(\"username or password does not match\");";
          echo "</script>";
          $connect->close();
          header("Location: https://worawanbydiistudent.store/login/register.php");
        } else {
          $connect->close();
          header("Location: https://worawanbydiistudent.store/index.php");
        }
      }
      $connect->close();
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
        <li style="float:right"><a href="https://web.facebook.com/don.jirapipat?fref=gs&__tn__=%2CdlC-R-R&eid=ARD4Hn7n7y0YlNmiFkRA4pRC8wT9s0jqzBWc2Ffc5Hr4JDyBq0oFcob2oUzlIG2Per5K2EaVj0spOoBE&hc_ref=ARQT8XqV-z45u9iOFih8e6NeW5FfLPr1_UoW7itb2PfNVQr5SznweAP6t5DFePjomUw&ref=nf_target&dti=2510061589261957&hc_location=group&_rdc=1&_rdr">ติดต่อเรา</a></li>
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
	 
	<form action="#" method="post" name="add" class="form-horizontal" id="add">
		<h1>Create Account</h1>
		<div class="register">
	<p></p>
  <div class="form-group">
  	 <div class="col-sm-2 control-label">
	<div class="input-group mb-3">
  
  </div>
    </div>

	 <div class="form-group">
    <div class="col-sm-2 control-label">
      ชื่อผู้ใช้ :
    </div>
    <div class="col-sm-2">
      <input type="text" id="Username" name="" required class="form-control" placeholder="Username">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label" class="form-control" >
      รหัสผ่าน :
    </div>
    <div class="col-sm-2">
      <input type="password" id="Password" name="" required class="form-control" placeholder="Password">     
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label" class="form-control" >
     ยืนยันรหัสผ่าน :
    </div>
    <div class="col-sm-2">
      <input type="password" name="" required class="form-control" placeholder="Confirm Password">     
    </div>
  </div>

    <div class="form-group">
  	 <div class="col-sm-2 control-label">

  </div>
    </div>

  <div class="form-group">
    <div class="col-sm-2 control-label">
      ชื่อ :
    </div>
    <div class="col-sm-3">
      <input type="text" id="Name" name="" required class="form-control" placeholder="Name">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      นามสกุล :
    </div>
    <div class="col-sm-3">
      <input type="text" id="Lastname" name="" required class="form-control" placeholder="Lastname">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      เบอร์โทร :
    </div>
    <div class="col-sm-3">
      <input type="text" id="Phone" name="" required class="form-control" placeholder="เช่น 091 999 9999">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      อีเมล์ :
    </div>
    <div class="col-sm-3">
     <input type="email" id="Email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
    </div>
  </div>
   <div class="form-group">
    <div class="col-sm-2 control-label">
      ที่อยู่ :
    </div>
    <div class="col-sm-3">
      <input type="text" id="Address1" name="" required class="form-control" placeholder="Address">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      ที่อยู่2 :
    </div>
    <div class="col-sm-3">
      <input type="text" id="Address2" name="" required class="form-control" placeholder="(ไม่จำเป็น)">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      ตำบล :
    </div>
    <div class="col-sm-3">
      <input type="text" id="State" name="" required class="form-control" placeholder="State">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      อำเภอ :
    </div>
    <div class="col-sm-3">
      <input type="text" id="City" name="" required class="form-control" placeholder="City">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
     จังหวัด :
    </div>
    <div class="col-sm-3">
      <input type="text" id="Province" name="" required class="form-control" placeholder="Province">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      รหัสไปรษณีย์ :
    </div>
    <div class="col-sm-3">
      <input type="text" id="Postcode" name="" required class="form-control" placeholder="Postcode">
    </div>
  </div>
	

  	<div class="form-group">
    <div class="col-sm-3">

	</div>

	<div class="form-group">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-3">
      <button type="submit" class="btn btn-primary">สมัครสมาชิก</button>
       <button type="" class="btn btn-danger">ยกเลิก</button>
    </div>
  </div>
</div>
</div>
	</form>

      <!--<form name="registeration_form"  method="post" action="register.php">
        <p><b>Registeration Form</b></p>
		<div class="register">
        <label for="Username">ชื่อผู้ใช้ *</label><br>
        <input type="text" id="Username" required name="Username" placeholder="Username"><br>
        <label for="Password">รหัสผ่าน *</label><br>
        <input type="password" id="Password" required name="Password" placeholder="Password"><br>
        <label for="Repassword">รหัสผ่านอีกครั้ง *</label><br>
        <input type="password" id="Repassword" required name="Repassword" placeholder="Password" onchange=""><br><br>
        <label for="Name">ชื่อจริง : </label><br>
        <input type="text" id="Name" required name="Name" placeholder="Name"><br> 
        <label for="Lastname">นามสกุล : </label><br>
        <input type="text" id="Lastname" required name="Lastname" placeholder="Lastname"><br>
        <label for="Address1">ที่อยู่ : </label>
        <input type="text" id="Address1" required name="Address1" placeholder="Address1"><br>
        <label for="Address2">ที่อยู่เพิ่มเติม(ไม่จำเป็น) : </label>
        <input type="text" id="Address2" name="Address2" placeholder="Address2"><br>
        <label for="State">ตำบล : </label>
        <input type="text" id="State" required name="State" placeholder="State">
		<label for="City">อำเภอ : </label>
        <input type="text" id="City" required name="City" placeholder="City"><br>
        <label for="Province">จังหวัด : </label>
        <input type="text" id="Province" required name="Province" placeholder="Province">
        <label for="Postcode">เลขที่ไปรษณีย์ : </label>
        <input type="text" id="Postcode" name="Postcode" placeholder="Postcode">
        <label for="Email">อีเมล : </label>
        <input type="text" id="Email" required name="Email" placeholder="Email">
        <label for="Phone">เบอร์โทรศัพท์ : </label>
        <input type="text" id="Phone" required name="Phone" placeholder="Phone">
        <input type="submit" name="" value="Submit">
        <input type="reset" name="" value="Clear">
		</div>
      </form>-->
    </div>
  </body>
</html>
