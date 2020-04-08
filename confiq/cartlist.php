<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    require_once('auth_confiq.php');
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
            'productqty'.$counter => $row['productqty'],
            $counter => $row['productcode']
          ] : [
            'productname'.$counter => $row['productname'],
            'productprice'.$counter => $row['productdprice'],
            'productimagepath'.$counter => $row['productimagepath'],
            'productqty'.$counter => $row['productqty'],
            $counter => $row['productcode']
          ]);
          $counter++;
        }
        while ($cart_row = $cart_list->fetch_assoc()) {
          $product_index = array_search($cart_row['itemcode'], $product_array, false);
          echo "<div class=\"menu__cart__field\"><span class=\"menu__cart__product__name\"><p>".$product_array['productname'.$product_index]."</p></span><span class=\"menu__cart__product__price\"><p>".$product_array['productprice'.$product_index]."฿</p></span>";
          echo "<span class=\"menu__cart__product__qty\"><input type=\"number\" class=\"menu__cart__product__qty__field\" name=\"".$cart_row['itemcode']."\" value=\"".$cart_row['itemqty']."\" data-ovalue=\"".$cart_row['itemqty']."\" min=\"1\" max=\"".$product_array['productqty'.$product_index]."\">";
          echo "</span><div class=\"menu__cart__product__action\"><div class=\"menu__cart__action\"><button type=\"button\" disabled class=\"button__icon button__green button__cart__upload\" data-nameq=\"".$cart_row['itemcode']."\"><i class=\"fas fa-cloud-upload-alt\"></i>Update</button>";
          echo "<button class=\"button__icon button__blue\"><i class=\"fas fa-eye\"></i>View</button><button type=\"button\" class=\"button__icon button__red button__cart__remove\" data-valueq=\"".$cart_row['itemcode']."\" data-valuea=\"".$cart_row['itemqty']."\" onclick=\"\">";
          echo "<i class=\"fas fa-trash-alt\"></i>Remove</button></div></div></div>";
        }
        $listmanager->close();
        $connect->close();
      } else {
        echo "<p class=\"cart__no__result\">Nothing was found in your cart.</p>";
        $listmanager->close();
        $connect->close();
      }
    } else {
      echo "";
      $listmanager->close();
      $connect->close();
    }
    ?>
  </body>
</html>
