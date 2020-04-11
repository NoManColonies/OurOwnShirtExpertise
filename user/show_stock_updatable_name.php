<?php
require_once('../.confiq/confiq.php');
if (session_auth_check($connect)['auth_key_valid']) {
  $retreive_product_result = $connect->query("select distinct productname from producttable");
  if (!empty($retreive_product_result->num_rows)) {
    ?>
    <h2>Product name</h2>
    <div class="select__box" id="name" value="">
      <div class="options__container search" id="productmodname">
    <?php
    $check_bit = false;
    while ($product_row = $retreive_product_result->fetch_assoc()) {
      ?>
      <div class="option">
        <input type="radio" class="radio" name="productmodname" id="<?php echo $product_row['productname']; ?>" value="<?php echo $product_row['productname']; ?>">
        <label for="<?php echo $product_row['productname']; ?>"><?php echo $product_row['productname']; ?></label>
      </div>
      <?php
    }
    ?>
      </div>
      <div class="selected">
        <p>Select product name</p>
        <span><i class="fas fa-chevron-down" aria-hidden="true"></i></span>
      </div>
      <div class="search__box" id="1">
        <input type="text" placeholder="Search for product...">
      </div>
    </div>
    <h2>Product size</h2>
    <div class="select__box" id="size" value="">
      <div class="options__container" id="productmodsize">
      </div>
      <div class="selected">
        <p>Select product size</p>
        <span><i class="fas fa-chevron-down" aria-hidden="true"></i></span>
      </div>
      <div class="search__box" id="2">
        <input type="text" placeholder="Search for size...">
      </div>
    </div>
    <h2>Product length</h2>
    <div class="select__box" id="length" value="">
      <div class="options__container" id="productmodlength">
      </div>
      <div class="selected">
        <p>Select product length</p>
        <span><i class="fas fa-chevron-down" aria-hidden="true"></i></span>
      </div>
    </div>
    <?php
  } else {
    ?>
    <p class="cart__no__result" style="padding: 40px">No product found.</p>
    <?php
  }
} else {
  echo "";
}
$connect->close();
?>
