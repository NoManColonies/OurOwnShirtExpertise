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
      $product_array = array_merge($product_array,
      [
        'productname'.$counter => $row['productname'],
        'productsize'.$counter => $row['productsize'],
        'productlength'.$counter => $row['productlength'],
        'productdprice'.$counter => $row['productdprice'],
        'productprice'.$counter => $row['productprice'],
        'productimagepath'.$counter => $row['productimagepath'],
        'productqty'.$counter => $row['productqty'],
        $counter => $row['productcode']
      ]);
      $counter++;
    }
    while ($cart_row = $cart_list->fetch_assoc()) {
      $product_index = array_search($cart_row['itemcode'], $product_array, false);
      ?>
      <div class="menu__cart__field">
        <span class="menu__cart__product__name">
          <p>Name: <?php echo $product_array['productname'.$product_index]; ?></p>
          <?php
          if (isset($product_array['productsize'.$product_index]) && $product_array['productsize'.$product_index] != "u" && !empty($product_array['productsize'.$product_index])) {
            ?>
            <p>Size: <?php echo $product_array['productsize'.$product_index]; ?></p>
            <?php
          }
          if (isset($product_array['productlength'.$product_index]) && $product_array['productlength'.$product_index] != "u" && !empty($product_array['productlength'.$product_index])) {
            ?>
            <p>Length:<?php echo $product_array['productlength'.$product_index]; ?></p>
            <?php
          }
          ?>
        </span>
        <span class="menu__cart__product__price">
          <?php
          if (isset($product_array['productdprice'.$product_index]) && !empty($product_array['productdprice'.$product_index])) {
            ?>
            <p class="discounted"><?php echo $product_array['productdprice'.$product_index]; ?>฿</p>
            <p><?php echo $product_array['productprice'.$product_index]; ?>฿</p>
            <?php
          } else {
            ?>
            <p><?php echo $product_array['productprice'.$product_index]; ?>฿</p>
            <?php
          }
          ?>
        </span>
        <span class="menu__cart__product__qty">
          <input type="number" class="menu__cart__product__qty__field" name="<?php echo $cart_row['itemcode']; ?>" value="<?php echo $cart_row['itemqty']; ?>" data-ovalue="<?php echo $cart_row['itemqty']; ?>" min="1" max="<?php echo $product_array['productqty'.$product_index]; ?>">
        </span>
        <div class="menu__cart__product__action">
          <div class="menu__cart__action">
            <button type="button" disabled class="button__icon button__green button__cart__upload" data-nameq="<?php echo $cart_row['itemcode']; ?>"><i class="fas fa-cloud-upload-alt"></i>Update</button>
            <button class="button__icon button__blue"><i class="fas fa-eye"></i>View</button>
            <button type="button" class="button__icon button__red button__cart__remove" data-valueq="<?php echo $cart_row['itemcode']; ?>" data-valuea="$cart_row['itemqty']" onclick=""><i class="fas fa-trash-alt"></i>Remove</button>
          </div>
        </div>
      </div>
      <?php
    }
    echo ",1";
    $listmanager->close();
    $connect->close();
  } else {
    ?>
    <p class="cart__no__result">Nothing was found in your cart.</p>
    <?php
    echo ",0";
    $listmanager->close();
    $connect->close();
  }
} else {
  $listmanager->close();
  $connect->close();
}
?>
