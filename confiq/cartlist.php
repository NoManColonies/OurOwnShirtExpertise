<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    require_once('.auth_confiq.php');
    $session = session_restore_result($connect);
    if ($session['session_valid']) {
      $cart_list = $listmanager->query("select * from ".$_SESSION['current_userid']."_cartlist where status=1");
      if (!empty($cart_list->num_rows)) {
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
        while ($cart_row = $retrieve_cart_list->fetch_assoc()) {
          $product_index = array_search($cart_row['itemcode'], $product_array, false);
          echo "<div class=\"menu__cart__field\"><p class=\"menu__cart__product__name\">".$product_array['productname'.$product_index]."</p><p class=\"menu__cart__product__price\">".$product_array['productprice'.$product_index]."</p><p class=\"menu__cart__product__qty\">".$cart_row['itemqty']."</p><div class=\"menu__cart__product__action\"><div class=\"menu__cart__action\"><button class=\"button__icon button__green\"><i class=\"fas fa-cloud-upload-alt\"></i>Update</button><button class=\"button__icon button__blue\"><i class=\"fas fa-eye\"></i>View</button><button class=\"button__icon button__red\"><i class=\"fas fa-trash-alt\"></i>Remove</button></div></div></div>";
        }
        $listmanager->close();
        $connect->close();
      } else {
        echo "nothing";
        $listmanager->close();
        $connect->close();
      }
    } else {
      echo "notvalid";
      $listmanager->close();
      $connect->close();
    }
    ?>
  </body>
</html>
