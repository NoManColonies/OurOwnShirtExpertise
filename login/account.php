<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet"href="../css/master.css">
    <title>Home</title>
  </head>
  <body>
    <div class="head">
      <ul>
        <li><a class="active" href="../index.php">หน้าหลัก</a></li>
        <li><a href="../about/about.php">เกี่ยวกับเรา</a></li>
        <li><a href="../shirt/shirt.php">เสื้อนักศึกษา</a></li>
        <li><a href="../sk/sk.php">กางเกง/กระโปรง</a></li>
        <li><a href="../shoes/shoes.php">รองเท้านักศึกษา</a></li>
        <li><a href="../other/other.php">อื่นๆ</a></li>
        <li style="float:right"><a href="https://www.google.com/webhp?hl=th&sa=X&ved=0ahUKEwiHoOHqmbPoAhUTbn0KHRc2BsIQPAgH">ค้นหา</a></li>
        <li style="float:right"><a href="https://web.facebook.com/don.jirapipat?fref=gs&__tn__=%2CdlC-R-R&eid=ARD4Hn7n7y0YlNmiFkRA4pRC8wT9s0jqzBWc2Ffc5Hr4JDyBq0oFcob2oUzlIG2Per5K2EaVj0spOoBE&hc_ref=ARQT8XqV-z45u9iOFih8e6NeW5FfLPr1_UoW7itb2PfNVQr5SznweAP6t5DFePjomUw&ref=nf_target&dti=2510061589261957&hc_location=group&_rdc=1&_rdr">ติดต่อเรา</a></li>
        <li style="float:right"><a href="account.php">บัญชี</a>
        <li style="float:right"><a href="logout.php">ออกจากระบบ</a></li>
        <?php
          require_once('../.confiq/confiq.php');
          if (!session_restore_result($connect, $server_url)) {
            $connect->close();
            header("Location: https://worawanbydiistudent.store/index.php");
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
      <?php
      switch ($_REQUEST['value']) {
        case 'true':
          $get_did_code = $connect->query("select uid from usercredentials where userid='".$_COOKIE['current_userid']."'");
          if ($get_did_code->num_rows == 0) {
            printf("Returned UID was NULL after second condition check has passed : [fetal]");
            exit();
          }
          $did_code = $get_did_code->fetch_assoc();
          $user_basic_data = $connect->query("select * from userbasicdata where did='".$did_code['uid']."'");
          $row = $user_basic_data->fetch_assoc();
          echo "<form action=\"account.php\" method=\"post\">";
          echo "<table><tr><td>ที่อยู่</td><td><input type=\"text\" name=\"Address1\" value=".$row['primaryaddress']."></td></tr>";
          echo "<tr><td>ที่อยู่เพิ่มเติม(ไม่จำเป็น)</td><td><input type=\"text\" name=\"Address2\" value=".$row['secondaryaddress']."></td></tr>";
          echo "<tr><td>อำเภอ</td><td><input type=\"text\" name=\"City\" value=".$row['city']."></td></tr>";
          echo "<tr><td>ตำบล</td><td><input type=\"text\" name=\"State\" value=".$row['state']."></td></tr>";
          echo "<tr><td>จังหวัด</td><td><input type=\"text\" name=\"Province\" value=".$row['province']."></td></tr>";
          echo "<tr><td>เลขที่ไปรษณีย์</td><td><input type=\"text\" name=\"Postcode\" value=".$row['postnum']."></td></tr>";
          echo "<tr><td>อีเมล</td><td><input type=\"text\" name=\"Email\" value=".$row['emailaddress']."></td></tr>";
          echo "<tr><td>เบอร์โทรศัพท์</td><td><input type=\"text\" name=\"Phone\" value=".$row['phonenumber']."></td></tr></table>";
          echo "<input type=\"hidden\" name=\"value\" value=\"false\"><input type=\"submit\" value=\"Submit\"></form>";
          $connect->close();
          break;
        case 'false':
          $get_did_code = $connect->query("select uid from usercredentials where userid='".$_COOKIE['current_userid']."'");
          if ($get_did_code->num_rows == 0) {
            printf("Returned UID was NULL after second condition check has passed : [fetal]");
            exit();
          }
          $did_code = $get_did_code->fetch_assoc();
          $update_userbasicdata_result = $connect->query("update userbasicdata set primaryaddress='".$_REQUEST['Address1']."' and secondaryaddress='".$_REQUEST['Address2']."' and city='".$_REQUEST['City']."' and state='".$_REQUEST['State']."' and province='".$_REQUEST['Province']."' and postnum='".$_REQUEST['Postcode']."' and emailaddress='".$_REQUEST['Email']."' and phonenumber='".$_REQUEST['Phone']."' where did=".$did_code['uid']."");
          if (!$update_userbasicdata_result) {
            printf("Failed to update userbasicdata : [fetal]");
            exit();
          }
        default:
          if ($get_did_code->num_rows == 0) {
            $get_did_code = $connect->query("select uid from usercredentials where userid='".$_COOKIE['current_userid']."'");
          }
          if ($get_did_code->num_rows == 0) {
            printf("Returned UID was NULL after edit_state was assigned to ".$_COOKIE['edit_state']." : [fetal]");
            exit();
          }
          $did_code = $get_did_code->fetch_assoc();
          $user_basic_data = $connect->query("select * from userbasicdata where did='".$did_code['uid']."'");
          if ($user_basic_data->num_rows == 0) {
            printf("Returned data is NULL at edit_state : false : [fetal]");
            exit();
          }
          $row = $user_basic_data->fetch_assoc();
          echo "<form action=\"account.php\" method=\"post\"><input type=\"hidden\" name=\"value\" value=\"true\"><input type=\"submit\" value=\"Edit\"></form>";
          echo "<table>";
          echo "<tr><td>ที่อยู่</td><td>".$row['primaryaddress']."</td></tr><tr><td>ที่อยู่เพิ่มเติม(ไม่จำเป็น)</td><td>".$row['secondaryaddress']."</td></tr><tr><td>อำเภอ</td><td>".$row['city']."</td></tr><tr><td>ตำบล</td><td>".$row['state']."</td></tr><tr><td>จังหวัด</td><td>".$row['province']."</td></tr><tr><td>เลขที่ไปรษณีย์</td><td>".$row['postnum']."</td></tr><tr><td>อีเมล</td><td>".$row['emailaddress']."</td></tr><tr><td>เบอร์โทรศัพท์</td><td>".$row['phonenumber']."</td></tr>";
          echo "</table>";
          $connect->close();
          break;
      }
      ?>
    </div>
    <center>
      <footer class="footer" style="margin-top: 50px"></footer>
    </center>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  </body>
</html>
