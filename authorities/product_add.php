<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet"href="../css/master.css">
    <title>Admin</title>
  </head>
  <body>
    <?php
    require_once('../.confiq/confiq.php');
    $session = session_auth_check($connect, $server_url);
    if (!$session['session_valid'] || !$session['auth_key_valid']) {
      $connect->close();
      header("Location: https://worawanbydiistudent.store/index.php");
    }
    ?>
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
            <a href="product_add.php"><i class="fas fa-user-shield"></i>เพิ่มสินค้า</a>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i>ออกจากระบบ</a>
          </div>
        </div>
        <a href="https://web.facebook.com/don.jirapipat?fref=gs&__tn__=%2CdlC-R-R&eid=ARD4Hn7n7y0YlNmiFkRA4pRC8wT9s0jqzBWc2Ffc5Hr4JDyBq0oFcob2oUzlIG2Per5K2EaVj0spOoBE&hc_ref=ARQT8XqV-z45u9iOFih8e6NeW5FfLPr1_UoW7itb2PfNVQr5SznweAP6t5DFePjomUw&ref=nf_target&dti=2510061589261957&hc_location=group&_rdc=1&_rdr"><i class="fas fa-address-book"></i>ติดต่อเรา</a>
      </div>
    </div>
    <form action="upload.php" method="post" enctype="multipart/form-data">
      <label for="file">Select Image File to Upload : </label>
      <input type="file" required name="file">
      <label for="productname">name : </label>
      <input type="text" required name="productname" value="">
      <label for="productdescription">description(optional) : </label>
      <input type="text" name="productdescription" value="">
      <label for="productprice">price : </label>
      <input type="text" required name="productprice" value="">
      <label for="productqty">quantity : </label>
      <input type="text" required name="productqty" value="">
      <label for="productdprice">discounted price(optional) : </label>
      <input type="text" name="productdprice" value="">
      <input type="submit" name="submit" value="Upload">
    </form>
  </body>
  <script src="https://kit.fontawesome.com/115266479a.js" crossorigin="anonymous"></script>
</html>
