<?php
require_once('../.confiq/confiq.php');
if (session_auth_check($connect)['session_valid']) {
  $product_name = $_REQUEST['q'];
  $retreive_product_result = $connect->query("select distinct productsize from producttable where productname='".$product_name."'");
  if (!empty($retreive_product_result->num_rows)) {
    ?>
    <h1>Item name: <?php echo $product_name; ?></h1>
    <h2>Product size</h2>
    <div class="select__box" id="size" value="" data-name="<?php echo $product_name; ?>">
      <div class="options__container" id="productbuysize">
    <?php
    $check_bit = false;
    while ($product_row = $retreive_product_result->fetch_assoc()) {
      if ($product_row['productsize'] != "u" && $product_row['productsize'] != "") {
        ?>
        <div class="option">
          <input type="radio" class="radio" name="productbuysize" id="<?php echo $product_row['productsize']; ?>" value="<?php echo $product_row['productsize']; ?>">
          <label for="<?php echo $product_row['productsize']; ?>"><?php echo $product_row['productsize']; ?></label>
        </div>
        <?php
      } else if (!$check_bit) {
        $check_bit = true;
        ?>
        <div class="option">
          <input type="radio" class="radio" name="productbuysize" id="default" value="u">
          <label for="default">Default</label>
        </div>
        <?php
      }
    }
    ?>
      </div>
      <div class="selected">
        <p>Select product size</p>
        <span><i class="fas fa-chevron-down" aria-hidden="true"></i></span>
      </div>
    </div>
    <h2>Product length</h2>
    <div class="select__box" id="length" value="">
      <div class="options__container" id="productbuylength">
      </div>
      <div class="selected">
        <p>Select product length</p>
        <span><i class="fas fa-chevron-down" aria-hidden="true"></i></span>
      </div>
    </div>
    <?php
  }
} else {
  echo "";
}
$connect->close();
?>
