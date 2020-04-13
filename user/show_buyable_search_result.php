<?php
require_once('../.confiq/confiq.php');
$session = session_restore_result($connect);
$search_term = (!empty($_REQUEST['q']))? " where productname like '%".$_REQUEST['q']."%' or producttitle like '%".$_REQUEST['q']."%' or productdescription like '%".$_REQUEST['q']."%'" : "";
$retreive_distinct_product_result = $connect->query("select distinct productname from producttable".$search_term);
if (!empty($retreive_distinct_product_result->num_rows)) {
  while ($name_row = $retreive_distinct_product_result->fetch_assoc()) {
    $retreive_all_product_result = $connect->query("select * from producttable where productname='".$name_row['productname']."'");
    if (!empty($retreive_all_product_result->num_rows)) {
      $price_array = [];
      $size_array = [];
      $length_array = [];
      $dprice_array = [];
      $code_array = [];
      $product_name = "";
      $product_title = "";
      $product_desc = "";
      $product_gender = "";
      $product_imagepath = "";
      while ($product_row = $retreive_all_product_result->fetch_assoc()) {
        $price_array = array_merge($price_array, array($product_row['productprice']));
        $dprice_array = array_merge($dprice_array, array($product_row['productdprice']));
        $code_array = array_merge($code_array, array($product_row['productcode']));
        if (empty($product_name)) {
          $product_name = $product_row['productname'];
        }
        if (empty($product_title) && isset($product_row['producttitle'])) {
          $product_title = $product_row['producttitle'];
        }
        if (empty($product_desc) && isset($product_row['productdescription'])) {
          $product_desc = $product_row['productdescription'];
        }
        if (empty($product_gender) && isset($product_row['productgender']) && !empty($product_row['productgender'])) {
          $product_gender = $product_row['productgender'];
        }
        if (empty($product_imagepath)) {
          $product_imagepath = $product_row['productimagepath'];
        }
      }
      $retreive_product_result = $connect->query("select distinct productsize from producttable where productname='".$product_name."'");
      if (!empty($retreive_product_result->num_rows)) {
        while ($row = $retreive_product_result->fetch_assoc()) {
          $size_array = array_merge($size_array, array($row['productsize']));
        }
      } else {
        $size_array = array("u");
      }
      $retreive_product_result = $connect->query("select distinct productlength from producttable where productname='".$product_name."'");
      if (!empty($retreive_product_result->num_rows)) {
        while ($row = $retreive_product_result->fetch_assoc()) {
          $length_array = array_merge($length_array, array($row['productlength']));
        }
      } else {
        $length_array = array("u");
      }
      ?>
      <div class="product__container">
        <img src="images/<?php echo $product_imagepath; ?>">
          <div class="desc">
            <p class="product__name"><?php echo $product_name; ?></p>
            <p class="product__detail"><?php echo $product_title; ?></p>
            <div class="product__price__group">
              <p class="product__price__tag">price :</p>
            <?php
            sort($price_array);
            sort($dprice_array);
            if (!is_null($price_array[0])) {
              $max = $price_array[0];
              $min = $price_array[0];
            } else {
              $max = 0;
              $min = 0;
            }
            if (!is_null($dprice_array[0])) {
              $maxd = $dprice_array[0];
              $mind = $dprice_array[0];
            } else {
              $maxd = 0;
              $mind = 0;
            }
            foreach (array_keys($price_array) as $key) {
              $maxd = ($dprice_array[$key] > $maxd)? $dprice_array[$key] : $maxd;
              $max = ($price_array[$key] > $max)? $price_array[$key] : $max;
              $mind = ($dprice_array[$key] < $mind)? $dprice_array[$key] : $mind;
              $min = ($price_array[$key] < $min)? $price_array[$key] : $min;
            }
            $check_bit = false;
            if ($mind > $min) {
              echo "<p class=\"product__price\">".$min."฿</p>";
              echo "<p class=\"product__price\">~</p>";
              $check_bit = true;
            } else if ($mind != $min && $mind != 0) {
              echo "<p class=\"product__price\">".$mind."฿</p>";
              echo "<p class=\"product__price\">~</p>";
              $check_bit = true;
            }
            if ($maxd > $max) {
              if (!$check_bit) {
                echo "<p class=\"product__price__specific\">".$maxd."฿</p>";
              } else {
                echo "<p class=\"product__price\">".$maxd."฿</p>";
              }
            } else if ($maxd != $max) {
              if (!$check_bit) {
                echo "<p class=\"product__price__specific\">".$max."฿</p>";
              } else {
                echo "<p class=\"product__price\">".$max."฿</p>";
              }
            }
            ?>
          </div>
        </div>
        <div class="spec">
          <div class="product__spec">
            <p class="product__size__tag">size :</p>
            <?php
            foreach ($size_array as $value) {
            if ($value != "u") {
              echo "<p class=\"product__size\">".$value."</p>";
              }
            }
            ?>
          </div>
          <?php
          $check_bit = false;
          foreach ($length_array as $value) {
            if ($value != "" && $value != "u") {
              if (!$check_bit) {
                ?>
                <div class="product__spec">
                  <p class="product__size__tag" style="margin-right: 0">length :</p>
                <?php
                $check_bit = true;
              }
              ?>
              <p class="product__size"><?php echo $value; ?>"</p>
              <?php
            }
          }
          if ($check_bit) {
            ?>
            </div>
            <?php
          }
          if ($product_gender != "u" && $product_gender != "") {
            ?>
            <div class="product__gender__group">
              <p class="product__gender__tag">gender :</p>
              <p class="product__gender"><?php echo $product_gender; ?></p>
            </div>
            <?php
          }
          if ($session['session_valid']) {
            ?>
            <div class="product__button__group">
              <button type="button" class="inspect__item button__green button__hover__expand__loggedin" value="<?php echo $product_name; ?>" onclick=""><i class="fas fa-external-link-alt" aria-hidden="true"></i></button>
              <button type="button" class="add__to__cart button__blue buy__loggedin" data-valueq="<?php echo $product_name; ?>" onclick=""><i class="fas fa-cart-arrow-down" aria-hidden="true"></i>add to cart</button>
            </div>
            <?php
          } else {
            ?>
            <div class="product__button__group">
              <button type="button" class="inspect__item button__green button__hover__expand__not__loggedin" value="<?php echo $product_name; ?>" onclick=""><i class="fas fa-external-link-alt" aria-hidden="true"></i></button>
              <button type="button" class="add__to__cart button__blue buy__not__loggedin" value="<?php echo $product_name; ?>" onclick="toggleRegisterMenu()" name="add"><i class="fas fa-shopping-bag" aria-hidden="true"></i>buy it now</button>
            </div>
            <?php
          }
          ?>
          </div>
        </div>
      </div>
      <?php
    }
  }
}
$connect->close();
?>
