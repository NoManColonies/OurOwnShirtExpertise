<?php
require_once('../.confiq/confiq.php');
$retreive_product_result = $connect->query("select distinct productsize from producttable where productname='".$_REQUEST['q']."'");
if (!empty($retreive_product_result->num_rows)) {
  $check_bit = false;
  while ($product_row = $retreive_product_result->fetch_assoc()) {
    if ($product_row['productsize'] != "u") {
      ?>
      <div class="option">
        <input type="radio" class="radio" name="productmodsize" id="<?php echo $product_row['productsize']; ?>" value="<?php echo $product_row['productsize']; ?>">
        <label for="<?php echo $product_row['productsize']; ?>"><?php echo $product_row['productsize']; ?></label>
      </div>
      <?php
    } else if (!$check_bit) {
      $check_bit = true;
      ?>
      <div class="option">
        <input type="radio" class="radio" name="productmodsize" id="default" value="u">
        <label for="default">Default</label>
      </div>
      <?php
    }
  }
} else {
  echo "";
}
$connect->close();
?>
