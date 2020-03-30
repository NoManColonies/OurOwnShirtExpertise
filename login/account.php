<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet"href="../css/master.css">
    <title>Home</title>
  </head>
  <?php
  require_once('../.confiq/confiq.php');
  if (!session_restore_result($connect, $server_url)) {
    $connect->close();
    header("Location: https://worawanbydiistudent.store/index.php");
  }
  ?>
  <body>
    <div class="grid__container">
      <div class="flex__container__left">
        <a href="../index.php"><i class="fas fa-home"></i>หน้าหลัก</a>
        <a href="../about/about.php"><i class="fas fa-building"></i>เกี่ยวกับเรา</a>
        <a href="../shirt/shirt.php"><i class="fas fa-tshirt"></i>เสื้อนักศึกษา</a>
        <a href="../sk/sk.php"><i class="fas fa-venus-mars"></i>กางเกง/กระโปรง</a>
        <a href="../shoes/shoes.php"><i class="fas fa-shoe-prints"></i>รองเท้านักศึกษา</a>
        <a href="../other/other.php"><i class="far fa-question-circle"></i>อื่นๆ</a>
      </div>
      <div class="flex__container__right">
        <a href="https://www.google.com/webhp?hl=th&sa=X&ved=0ahUKEwiHoOHqmbPoAhUTbn0KHRc2BsIQPAgH"><i class="fas fa-search"></i>ค้นหา</a>
        <div class="menu">
          <div class="menu__btn"><a href="#"><i class="fas fa-user-shield"></i>บัญชี</a></div>
          <div class="smenu">
            <a href="account.php"><i class="fas fa-edit"></i>แก้ไขข้อมูล</a>
            <a href="transaction.php"><i class="fas fa-clipboard-list"></i>ประวัติการซื้อ</a>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i>ออกจากระบบ</a>
          </div>
        </div>
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
      <?php
      if (isset($_REQUEST['passchange']) && !empty($_REQUEST['passchange'])) {
        echo "<form action=\"account.php\"><table><tr>Old password : <td></td><td><input type=\"password\" name=\"Oldpass\"></td></tr>";
        echo "<tr><td>New password : </td><td><input type=\"password\" name=\"Newpass\"></td></tr>";
        echo "<tr><td>Retype password : </td><td><input type=\"password\" name=\"Repass\"></td></tr></table><input type=\"hidden\" name=\"passchange\" value=\"false\"><input type=\"submit\" value=\"Submit\"></form>";
        $connect->close();
      } else {
        switch ($_REQUEST['basicdata']) {
          case 'true':
          $get_did_code = $connect->query("select uid from usercredentials where userid='".$_COOKIE['current_userid']."'");
          if (empty($get_did_code->num_rows)) {
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
          echo "<input type=\"hidden\" name=\"basicdata\" value=\"false\"><input type=\"submit\" value=\"Submit\"></form>";
          $connect->close();
          break;
          case 'false':
          $get_did_code = $connect->query("select uid from usercredentials where userid='".$_COOKIE['current_userid']."'");
          if (empty($get_did_code->num_rows)) {
            printf("Returned UID was NULL after second condition check has passed : [fetal]");
            exit();
          }
          $did_code = $get_did_code->fetch_assoc();
          $update_userbasicdata_result = $connect->query("update userbasicdata set primaryaddress='".$_REQUEST['Address1']."', secondaryaddress='".$_REQUEST['Address2']."', city='".$_REQUEST['City']."', state='".$_REQUEST['State']."', province='".$_REQUEST['Province']."', postnum='".$_REQUEST['Postcode']."', emailaddress='".$_REQUEST['Email']."', phonenumber='".$_REQUEST['Phone']."' where did='".$did_code['uid']."'");
          if (!$update_userbasicdata_result) {
            printf("Failed to update userbasicdata : [fetal]");
            exit();
          }
          default:
          if (isset($_REQUEST['passchange'])) {
            $check_password_result = $connect->query("select userpassword from usercredentials where userid='".$_COOKIE['current_userid']."'");
            if (empty($check_password_result->num_rows)) {
              printf("Failed to match userid when try to change password : [fetal]");
            }
            $password_string = $check_password_result->fetch_assoc();
            if (!password_verify($_REQUEST['Oldpass'], $password_string)) {
              $connect->close();
              header("Location: https://worawanbydiistudent.store/login/account.php");
            }
            if ($_REQUEST['Newpass'] == $_REQUEST['Repass']) {
              $connect->close();
              header("Location: https://worawanbydiistudent.store/login/account.php?passchange=true");
            }
            $try_to_update_password = $connect->query("update usercredentials set userpassword='".$_REQUEST['Newpass']."' where userid='".$_COOKIE['current_userid']."'");
            if (!$try_to_update_password) {
              printf("Failed to update password at userid : ".$_COOKIE['current_userid']." : [fetal]");
              exit();
            }
          }
          if (is_null($get_did_code)) {
            $get_did_code = $connect->query("select uid from usercredentials where userid='".$_COOKIE['current_userid']."'");
            $did_code = $get_did_code->fetch_assoc();
          }
          if (empty($get_did_code->num_rows)) {
            printf("Returned UID was NULL after edit_state was assigned to ".$_COOKIE['edit_state']." : [fetal]");
            exit();
          }
          $user_basic_data = $connect->query("select * from userbasicdata where did='".$did_code['uid']."'");
          if (empty($user_basic_data->num_rows)) {
            printf("Returned data is NULL at edit_state : NULL. DID : ".$did_code['uid']." : [fetal]");
            exit();
          }
          $row = $user_basic_data->fetch_assoc();
          echo "<form action=\"account.php\" method=\"get\"><input type=\"hidden\" name=\"basicdata\" value=\"true\"><input type=\"submit\" value=\"Edit data\"></form>";
          echo "<form action=\"account.php\" method=\"get\"><input type=\"hidden\" name=\"passchange\" value=\"true\"><input type=\"submit\" value=\"Change password\"></from>";
          echo "<table>";
          echo "<tr><td>ที่อยู่ : </td><td>".$row['primaryaddress']."</td></tr><tr><td>ที่อยู่เพิ่มเติม(ไม่จำเป็น) : </td><td>".$row['secondaryaddress']."</td></tr><tr><td>อำเภอ : </td><td>".$row['city']."</td></tr><tr><td>ตำบล : </td><td>".$row['state']."</td></tr><tr><td>จังหวัด : </td><td>".$row['province']."</td></tr><tr><td>เลขที่ไปรษณีย์ : </td><td>".$row['postnum']."</td></tr><tr><td>อีเมล : </td><td>".$row['emailaddress']."</td></tr><tr><td>เบอร์โทรศัพท์ : </td><td>".$row['phonenumber']."</td></tr>";
          echo "</table>";
          $connect->close();
          break;
        }
      }
      ?>
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
