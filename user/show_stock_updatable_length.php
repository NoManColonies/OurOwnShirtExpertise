<?php
require_once('../.confiq/confiq.php');
$retreive_product_result = $connect->query("select distinct productlength from producttable where productname='".$_REQUEST['q']."' and productsize='".$_REQUEST['s']."'");
if (!empty($retreive_product_result->num_rows)) {
  $check_bit = false;
  while ($product_row = $retreive_product_result->fetch_assoc()) {
    if ($product_row['productlength'] != "" && $product_row['productlength'] != "u") {
      echo "<option value=\"".$product_row['productlength']."\">".$product_row['productlength']."</option>";
      ?>
      <div class="option">
        <input type="radio" class="radio" name="productmodlength" id="<?php echo $product_row['productlength']; ?>" value="<?php echo $product_row['productlength']; ?>">
        <label for="<?php echo $product_row['productlength']; ?>"><?php echo $product_row['productlength']; ?>"</label>
      </div>
      <?php
    } else if (!$check_bit) {
      $check_bit = true;
      echo "<option value=\"u\">Default</option>";
      ?>
      <div class="option">
        <input type="radio" class="radio" name="productmodlength" id="default" value="u">
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
