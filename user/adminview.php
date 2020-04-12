<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../webfontkit/stylesheet.css">
    <link rel="stylesheet" href="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/wtf-forms.css">
    <title>Billing list details</title>
  </head>
  <body>
    <?php
    require_once('../.confiq/confiq.php');
    $session = session_auth_check($connect);
    if (!$session['session_valid'] || !$session['auth_key_valid']) {
      $connect->close();
      header("Location: https://worawanbydiistudent.store/index.php");
      exit();
    }
    ?>
    <div class="view__billing__info">
      <?php
      $query = "select * from billinglist where keyhash='".$_REQUEST['q']."'";
      $retreive_billinglist = $connect->query($query);
      if (!empty($retreive_billinglist->num_rows)) {
        $billing_row = $retreive_billinglist->fetch_assoc();
        ?>
        <p>User ID: <?php echo $billing_row['userid']; ?></p>
        <p>Key: <?php echo $billing_row['keyhash']; ?></p>
        <table border="2px solid">
          <tr>
            <th>Item name</th>
            <th>Size</th>
            <th>Length</th>
            <th>Price</th>
            <th>Discounted price</th>
            <th>Item code</th>
            <th>Order quantity</th>
          </tr>
          <?php
          $product_code_array = explode(',', $billing_row['itemid']);
          $product_qty_array = explode(',', $billing_row['itemqty']);
          for ($i = 0; $i < count($product_code_array); $i++) {
            $query = "select * from producttable where productcode='".$product_code_array[$i]."'";
            $retreive_product_result = $connect->query($query);
            if (!empty($retreive_product_result->num_rows)) {
              $product_row = $retreive_product_result->fetch_assoc();
              ?>
              <tr>
                <td><?php echo $product_row['productname']; ?></td>
                <td><?php echo $product_row['productsize']; ?></td>
                <td><?php echo $product_row['productlength']; ?></td>
                <td><?php echo $product_row['productprice']; ?></td>
                <td><?php echo $product_row['productdprice']; ?></td>
                <td><?php echo $product_code_array[$i]; ?></td>
                <td><?php echo $product_qty_array[$i]; ?></td>
              </tr>
              <?php
            } else {
              alert_message("Failed to retreive product from billing list. error code : ".$connect->errno." query : ".$query);
            }
          }
          ?>
        </table>
        <?php
      } else {
        ?>
        <p class="cart__no__result">Found nothing. :(</p>
        <?php
      }
      $connect->close();
      ?>
    </div>
  </body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="../script_admin.js" charset="utf-8"></script>
  <script src="https://kit.fontawesome.com/115266479a.js" crossorigin="anonymous"></script>
</html>
