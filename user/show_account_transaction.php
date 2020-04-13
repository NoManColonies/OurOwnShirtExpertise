<?php
require_once('../.confiq/confiq.php');
if (session_restore_result($connect)['session_valid']) {
  $retreive_billinglist = $connect->query("select * from billinglist where userid='".$_SESSION['current_userid']."'");
  if (!empty($retreive_billinglist->num_rows)) {
    while ($billing_row = $retreive_billinglist->fetch_assoc()) {
      ?>
      <span class="tabcontent__key">
        <p>Key: <?php echo $billing_row['keyhash']; ?></p>
        <p>status: <?php echo $billing_row['status']; ?></p>
      </span>
      <span class="tabcontent__spec">
        <p class="name">name</p>
        <p class="size">size</p>
        <p class="length">length</p>
        <p class="quantity">quantity</p>
        <?php
        $product_code_array = explode(',', $billing_row['itemid']);
        $product_qty_array = explode(',', $billing_row['itemqty']);
        for ($i = 0; $i < count($product_code_array); $i++) {
          $retreive_product_result = $connect->query("select * from producttable where productcode='".$product_code_array[$i]."'");
          if (!empty($retreive_product_result->num_rows)) {
            $product_row = $retreive_product_result->fetch_assoc();
            ?>
            <p class="name"><?php echo $product_row['productname']; ?></p>
            <p class="size"><?php echo $product_row['productsize']; ?></p>
            <p class="length"><?php echo ($product_row['productlength'] == "")? "Default" : $product_row['productlength']; ?></p>
            <p class="quantity"><?php echo $product_qty_array[$i]; ?></p>
            <?php
          }
        }
        ?>
      </span>
      <span class="tabcontent__price">
        <p>price</p>
        <?php
        foreach ($i = 0; $i < count($product_code_array); $i++) {
          $retreive_product_result = $connect->query("select * from producttable where productcode='".$product_code_array[$i]."'");
          if (!empty($retreive_product_result->num_rows)) {
            $product_row = $retreive_product_result->fetch_assoc();
            ?>
            <p><?php echo $product_row['productqty']*$product_qty_array[$i]; ?>฿</p>
            <?php
          }
        }
        ?>
      </span>
      <?php
    }
  }
}
?>
