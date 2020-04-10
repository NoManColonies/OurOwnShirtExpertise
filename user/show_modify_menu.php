<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    require_once('../.confiq/confiq.php');
    $product_name = $_REQUEST['q'];
    $retrieve_product_result = $connect->query("select * from producttable where productname='".$product_name."'");
    if (!empty($retrieve_product_result->num_rows)) {
      $size_array = [];
      $product_title = NULL;
      $product_desc = NULL;
      $product_gender = NULL;
      $product_imagepath = NULL;
      echo "<input type=\"hidden\" name=\"selected\" value=\"\">";
      while ($product_row = $retrieve_product_result->fetch_assoc()) {
        $length = (empty($product_row['productlength']))? "u" : $product_row['productlength'];
        echo "<input type=\"hidden\" name=\"product\" data-size=\"".$product_row['productsize']."\" data-length=\"".$length."\" data-price=\"".$product_row['productprice']."\" data-dprice=\"".$product_row['productdprice']."\" data-code=\"".$product_row['productcode']."\">";
        if (is_null($product_title)) {
          $product_title = $product_row['producttitle'];
        }
        if (is_null($product_desc)) {
          $product_desc = $product_row['productdescription'];
        }
        if (is_null($product_gender)) {
          $product_gender = $product_row['productgender'];
        }
        if (is_null($product_imagepath)) {
          $product_imagepath = $product_row['productimagepath'];
        }
      }
      $retreive_distinct_product_result = $connect->query("select distinct productsize from producttable where productname='".$product_name."'");
      if (!empty($retreive_distinct_product_result->num_rows)) {
        while ($row = $retreive_distinct_product_result->fetch_assoc()) {
          $size_array = array_merge($size_array, array($row['productsize']));
        }
      } else {
        $size_array = array("u");
      }
      echo "<div class=\"input__icon\">
        <input type=\"text\" required name=\"productname\" class=\"input__glow\" value=\"".$product_name."\" placeholder=\"Item name\">
        <div class=\"icon__snap__field\">
          <div class=\"icon__snap__field__relative\">
            <i class=\"fas fa-shopping-bag fa-lg fa-fw input__snap\" aria-hidden=\"true\"></i>
          </div>
        </div>
      </div>";
      echo "<div class=\"input__icon\">
        <input type=\"text\" name=\"producttitle\" class=\"input__glow\" value=\"".$product_title."\" placeholder=\"Item display title/search keyword\">
        <div class=\"icon__snap__field\">
          <div class=\"icon__snap__field__relative\">
            <i class=\"fab fa-slack-hash fa-lg fa-fw input__snap\" aria-hidden=\"true\"></i>
          </div>
        </div>
      </div>";
      echo "<div class=\"input__icon\">
        <textarea name=\"productdescription\" rows=\"4\" cols=\"80\" class=\"input__glow\">".$product_desc."</textarea><br>
        <div class=\"icon__snap__field full__size\">
          <div class=\"icon__snap__field__relative\">
            <i class=\"fas fa-book-reader fa-lg fa-fw input__snap\" aria-hidden=\"true\"></i>
          </div>
        </div>
      </div>";
      echo "<div class=\"input__icon\">
        <input type=\"number\" required name=\"productprice\" class=\"input__glow\" value=\"\" placeholder=\"Item price\">
        <div class=\"icon__snap__field\">
          <div class=\"icon__snap__field__relative\">
            <i class=\"fas fa-tag fa-lg fa-fw input__snap\" aria-hidden=\"true\"></i>
          </div>
        </div>
      </div>";
      echo "<div class=\"input__icon\">
        <input type=\"text\" name=\"productgender\" value=\".$product_gender.\" class=\"input__glow\" placeholder=\"Gender this item is for (Optional)\">
        <div class=\"icon__snap__field\">
          <div class=\"icon__snap__field__relative\">
            <i class=\"fas fa-venus-double fa-lg fa-fw input__snap\" aria-hidden=\"true\"></i>
          </div>
        </div>
      </div>";
      echo "<div class=\"input__icon\">
        <input type=\"text\" name=\"productsizeedit\" value=\"\" class=\"input__glow\" placeholder=\"Item size\">
        <div class=\"icon__snap__field\">
          <div class=\"icon__snap__field__relative\">
            <i class=\"fas fa-venus-double fa-lg fa-fw input__snap\" aria-hidden=\"true\"></i>
          </div>
        </div>
      </div>";
      echo "<div class=\"input__icon\">
        <input type=\"text\" name=\"productlengthedit\" value=\"\" class=\"input__glow\" placeholder=\"Item length(Optional)\">
        <div class=\"icon__snap__field\">
          <div class=\"icon__snap__field__relative\">
            <i class=\"fas fa-venus-double fa-lg fa-fw input__snap\" aria-hidden=\"true\"></i>
          </div>
        </div>
      </div>";
      echo "<div class=\"select\">
        <select aria-label=\"Select menu example\" name=\"productsize\">
          <option selected>Please select the size</option>";
          $check_bit = false;
          foreach ($size_array as $value) {
            if ($value != "u") {
              echo "<option value=\"".$value."\">".$value."</option>";
            } else if (!$check_bit) {
              $check_bit = true;
              echo "<option value=\"u\">Default</option>";
            }
          }
      echo "</select></div>";
      echo "<div class=\"select\">
        <select aria-label=\"Select menu example\" name=\"productlength\">
          <option selected>Please select the length</option>";
          /*
          $check_bit = false;
          foreach ($length_array as $value) {
            if ($value != "" && $value != "u") {
              echo "<option value=\"".$value."\">".$value."</option>";
            } else if (!$check_bit) {
              $check_bit = true;
              echo "<option value=\"u\">Default</option>";
            }
          }
          */
      echo "</select></div>";
      echo "<div class=\"input__icon\">
        <input type=\"number\" name=\"productdprice\" value=\"\" class=\"input__glow\" placeholder=\"Discounted price (Optional)\">
        <div class=\"icon__snap__field\">
          <div class=\"icon__snap__field__relative\">
            <i class=\"fas fa-percentage fa-lg fa-fw input__snap\" aria-hidden=\"true\"></i>
          </div>
        </div>
      </div>";
      echo "<div class=\"input__icon\">
        <input type=\"text\" name=\"productimagepath\" value=\"".$product_imagepath."\" class=\"input__glow\" placeholder=\"File path in case of image was already uploaded (Optional)\">
        <div class=\"icon__snap__field\">
          <div class=\"icon__snap__field__relative\">
            <i class=\"fas fa-file-signature fa-lg fa-fw input__snap\" aria-hidden=\"true\"></i>
          </div>
        </div>
      </div>";
      echo "<div class=\"modify__group\">
        <label class=\"file\">
          <input type=\"file\" id=\"file\" aria-label=\"File browser example\">
          <span class=\"file-custom\"></span>
        </label>
        <input type=\"hidden\" name=\"code\" value=\"".$product_name."\">
        <button type=\"submit\" disabled name=\"submit\" class=\"button__icon button__blue button__modify__menu\" onclick=\"\" style=\"margin-left: 1em\"><i class=\"fas fa-edit\"></i>modify</button>
      </div>";
    } else {
      echo "<p class=\"cart__no__result\">Oops! Can't find what you are looking for.</p>";
    }
    $connect->close();
    ?>
  </body>
</html>
