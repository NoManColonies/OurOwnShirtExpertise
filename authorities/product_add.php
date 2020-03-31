<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet"href="../css/master.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <style>
      body {
        font-family: Arial;
        padding: 5px 5px 50px 5px;
      }

      input[type=text], select {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
      }

      input[type=submit] {
        width: 100%;
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
      }

      input[type=submit]:hover {
        background-color: #45a049;
      }

      div.container {
        border-radius: 5px;
        background-color: #f2f2f2;
        padding: 20px 20px 80px 20px;
      }
      .buttonload {
        background-color: #4CAF50;
        border: 5px 5px 5px 5px;
        color: white;
        float: right;
        margin: 5px 5px 5px 5px;
        padding: 12px 24px;
        font-size: 16px;
      }


      .fa {
        margin-left: -12px;
        margin-right: 8px;
      }
      .form_upload{
      font-size:50px;
      font-family:Algerian;
      }
    </style>
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
      <div class="form_upload">
        <marquee direction="right">Form to Upload</marquee>
      </div>
      <div class="container">
        <label for="file">Select Image File to Upload : </label>
        <input type="file" required name="file"><br>
        <label for="productname">name : </label>
        <input type="text" required name="productname" value="">
        <label for="productdescription">description(optional) : </label><br>
        <textarea name="productdescription" rows="8" cols="80"></textarea><br>
        <label for="productprice">price : </label>
        <input type="text" required name="productprice" value="">
        <label for="productqty">quantity : </label>
        <input type="text" required name="productqty" value="">
        <label for="productdprice">discounted price(optional) : </label>
        <input type="text" name="productdprice" value="">
        <button type="submit" name="submit" class="buttonload"><i type="submit" name="submit" class="fa fa-refresh fa-spin"></i>Upload</button>
      </div>
    </form>
  </body>
  <script src="https://kit.fontawesome.com/115266479a.js" crossorigin="anonymous"></script>
</html>
