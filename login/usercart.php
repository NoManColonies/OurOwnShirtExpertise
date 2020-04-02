<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  <link type="text/css" rel="stylesheet"href="../css/master.css">
  <title>Cart</title>
</head>
<?php
require_once('../.confiq/auth_confiq.php');
$session = session_auth_check($connect, $server_url);
if ($session['auth_key_valid']) {
  $listmanager->close();
  error_alert($connect, "You as an admin tried to access client only content. Terminating...");
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
        <?php
        if ($session['session_valid']) {
          echo "<div class=\"menu\"><div class=\"menu__btn\"><a href=\"#\"><i class=\"fas fa-user-shield\"></i>บัญชี</a></div><div class=\"smenu\"><a href=\"../login/usercart.php\"><i class=\"fas fa-shopping-cart\"></i>ตระกร้าสินค้า</a><a href=\"../login/transaction.php\"><i class=\"fas fa-clipboard-list\"></i>ประวัติการซื้อ</a><a href=\"../login/account.php\"><i class=\"fas fa-edit\"></i>แก้ไขข้อมูล</a><a href=\"../login/logout.php\"><i class=\"fas fa-sign-out-alt\"></i>ออกจากระบบ</a></div></div>";
        } else {
          echo "<a href=\"../login/usercart.php\"><i class=\"fas fa-shopping-cart\"></i>ตระกร้าสินค้า</a><a href=\"../login/login.php\"><i class=\"fas fa-sign-in-alt\"></i>เข้าสู่ระบบ</a>";
        }
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
      <?php
      if ($session['session_valid']) {
        $retrieve_cart_list = $listmanager->query("select * from ".$_SESSION['current_userid']."_cartlist where status=1");
        if (empty($retrieve_cart_list->num_rows)) {
          echo "<p>Nothing is in your cart :(</p>";
        } else {
          $retrieve_product_result = $connect->query("select * from producttable");
          $product_array = [];
          $counter = 0;
          while ($row = $retrieve_product_result->fetch_assoc()) {
            $product_array = array_merge($product_array, (is_null($row['productdprice']))? [
              'productname'.$counter => $row['productname'],
              'productprice'.$counter => $row['productprice'],
              'productimagepath'.$counter => $row['productimagepath'],
              $counter => $row['productcode']
            ] : [
              'productname'.$counter => $row['productname'],
              'productprice'.$counter => $row['productdprice'],
              'productimagepath'.$counter => $row['productimagepath'],
              $counter => $row['productcode']
            ]);
            $counter++;
          }
          echo "<table><tr><th>Product name</th><th>Price</th><th>Quantity</th><th>Link</th></tr>";
          while ($cart_row = $retrieve_cart_list->fetch_assoc()) {
            $product_index = array_search($cart_row['itemcode'], $product_array, false);
            echo "<tr><td>".$product_array['productname'.$product_index]."</td><td>".$product_array['productprice'.$product_index]."</td><td>".$cart_row['itemqty']."</td><td>".$product_array['productimagepath'.$product_index]."</td></tr>";
          }
          echo "</table>";
        }
      } else {
        if (isset($_COOKIE['guestcart'])) {
          $retrieve_product_result = $connect->query("select * from producttable");
          $product_array = [];
          $counter = 0;
          while ($row = $retrieve_product_result->fetch_assoc()) {
            $counter++;
            $product_array = array_merge($product_array, (is_null($row['productdprice']))? [
              'productname'.$counter => $row['productname'],
              'productprice'.$counter => $row['productprice'],
              'productimagepath'.$counter => $row['productimagepath'],
              $counter => $row['productcode']
            ] : [
              'productname'.$counter => $row['productname'],
              'productprice'.$counter => $row['productdprice'],
              'productimagepath'.$counter => $row['productimagepath'],
              $counter => $row['productcode']
            ]);
          }
          $guest_cart = json_decode($_COOKIE['guestcart']);
          echo "<table><tr><th>Product name</th><th>Price</th><th>Quantity</th><th>Link</th></tr>";
          foreach ($guest_cart as $key => $value) {
            $product_index = array_search($key, $product_array, false);
            echo "<tr><td>".$product_array['productname'.$product_index]."</td><td>".$product_array['productprice'.$product_index]."</td><td>".$value."</td><td>".$product_array['productimagepath'.$product_index]."</td></tr>";
          }
          echo "</table>";
        } else {
          echo "<p>Nothing is in your cart :(</p>";
        }
      }
      $listmanager->close();
      $connect->close();
      ?>
    </div>
  </body>
  <script src="https://kit.fontawesome.com/115266479a.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</html>
