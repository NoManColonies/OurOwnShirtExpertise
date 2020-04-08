<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    require_once('../.confiq/confiq.php');
    $retreive_product_result = $connect->query("select * from producttable where productcode='".$_REQUEST['q']."'");
    if (!empty($retrieve_product_result->num_rows)) {
      $product_row = $retreive_product_result->fetch_assoc();
      echo "<div class=\"input__icon\">
        <input type=\"text\" required name=\"productname\" class=\"input__glow\" value=\"".$product_row['productname']."\" placeholder=\"Item name\">
        <div class=\"icon__snap__field\">
          <div class=\"icon__snap__field__relative\">
            <i class=\"fas fa-shopping-bag fa-lg fa-fw input__snap\" aria-hidden=\"true\"></i>
          </div>
        </div>
      </div>";
      echo "<div class=\"input__icon\">
        <input type=\"text\" required name=\"producttitle\" class=\"input__glow\" value=\"".$product_row['producttitle']."\" placeholder=\"Item display title/search keyword\">
        <div class=\"icon__snap__field\">
          <div class=\"icon__snap__field__relative\">
            <i class=\"fab fa-slack-hash fa-lg fa-fw input__snap\" aria-hidden=\"true\"></i>
          </div>
        </div>
      </div>";
      echo "<div class=\"input__icon\">
        <textarea name=\"productdescription\" rows=\"4\" cols=\"80\" class=\"input__glow\">".$product_row['productdescription']."</textarea><br>
        <div class=\"icon__snap__field full__size\">
          <div class=\"icon__snap__field__relative\">
            <i class=\"fas fa-book-reader fa-lg fa-fw input__snap\" aria-hidden=\"true\"></i>
          </div>
        </div>
      </div>";
      echo "<div class=\"input__icon\">
        <input type=\"number\" required name=\"productprice\" class=\"input__glow\" value=\"".$product_row['productprice']."\" placeholder=\"Item price\">
        <div class=\"icon__snap__field\">
          <div class=\"icon__snap__field__relative\">
            <i class=\"fas fa-tag fa-lg fa-fw input__snap\" aria-hidden=\"true\"></i>
          </div>
        </div>
      </div>";
      echo "<div class=\"input__icon\">
        <input type=\"text\" name=\"productsize\" value=\"".$product_row['productsize']."\" class=\"input__glow\" placeholder=\"Size of the item (Optional)\">
        <div class=\"icon__snap__field\">
          <div class=\"icon__snap__field__relative\">
            <i class=\"fas fa-ruler-combined fa-lg fa-fw input__snap\" aria-hidden=\"true\"></i>
          </div>
        </div>
      </div>";
      echo "<div class=\"input__icon\">
        <input type=\"text\" name=\"productgender\" value=\"\" class=\"input__glow\" placeholder=\"Gender this item is for (Optional)\">
        <div class=\"icon__snap__field\">
          <div class=\"icon__snap__field__relative\">
            <i class=\"fas fa-venus-double fa-lg fa-fw input__snap\" aria-hidden=\"true\"></i>
          </div>
        </div>
      </div>";
      echo "<div class=\"input__icon\">
        <input type=\"text\" name=\"productlength\" value=\"".$product_row['productlength']."\" class=\"input__glow\" placeholder=\"length of the item (Optional)\">
        <div class=\"icon__snap__field\">
          <div class=\"icon__snap__field__relative\">
            <i class=\"fas fa-pencil-ruler fa-lg fa-fw input__snap\" aria-hidden=\"true\"></i>
          </div>
        </div>
      </div>";
      echo "<div class=\"input__icon\">
        <input type=\"text\" name=\"productdprice\" value=\"".$product_row['productdprice']."\" class=\"input__glow\" placeholder=\"Discounted price (Optional)\">
        <div class=\"icon__snap__field\">
          <div class=\"icon__snap__field__relative\">
            <i class=\"fas fa-percentage fa-lg fa-fw input__snap\" aria-hidden=\"true\"></i>
          </div>
        </div>
      </div>";
      echo "<div class=\"input__icon\">
        <input type=\"text\" name=\"productimagepath\" value=\"".$product_row['productimagepath']."\" class=\"input__glow\" placeholder=\"File path in case of image was already uploaded (Optional)\">
        <div class=\"icon__snap__field\">
          <div class=\"icon__snap__field__relative\">
            <i class=\"fas fa-file-signature fa-lg fa-fw input__snap\" aria-hidden=\"true\"></i>
          </div>
        </div>
      </div>";
      echo "<div class=\"add__product__group\">
        <label class=\"file\">
          <input type=\"file\" id=\"file\" aria-label=\"File browser example\">
          <span class=\"file-custom\"></span>
        </label>
        <input type=\"hidden\" name=\"code\" value=\"".$_REQUEST['q']."\">
        <button type=\"submit\" name=\"submit\" class=\"button__icon button__blue button__modify__menu\" onclick=\"\" style=\"margin-left: 1em\"><i class=\"fas fa-edit\"></i>modify</button>
      </div>";
    } else {
      echo "<p class=\"cart__no__result\">Oops! Can't find what you are looking for.</p>";
    }
    $connect->close();
    ?>
  </body>
</html>
