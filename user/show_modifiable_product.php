<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    require_once('../.confiq/confiq.php');
    $retreive_distinct_product_result = $connect->query("select distinct productname from producttable");
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
            $price_array = array_merge($size_array, array($product_row['productprice']));
            $size_array = array_merge($size_array, array($product_row['productsize']));
            $length_array = array_merge($length_array, array($product_row['productlength']));
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
            if (empty($product_gender) && isset($product_row['productgender'])) {
              $product_gender = $product_gender['productgender'];
            }
            if (empty($product_imagepath)) {
              $product_imagepath = $product_row['productimagepath'];
            }
          }
          echo "<div class=\"product__container\">";
          echo "<img src=\"images/".$product_imagepath."\">";
          echo "<div class=\"desc\">";
          echo "<p class=\"product__name\">".$product_name."</p>";
          echo "<p class=\"product__detail\">".$product_title."</p>";
          echo "<div class=\"product__price__group\">";
          echo "<p class=\"product__price__tag\">price :</p>";
          for ($i = 0; $i < count($price_array); $i++) {
            if (is_null($dprice_array[$i])) {
              echo "<p class=\"product__price\">".$price_array[$i]."฿</p>";
            } else {
              echo "<p class=\"product__price discounted\">".$price_array[$i]."฿</p>";
              echo "<p class=\"product__discounted__price\">".$dprice_array[$i]."฿</p>";
            }
          }
          echo "</div></div>";
          echo "<div class=\"spec\">";
          echo "<div class=\"product__spec\">";
          echo "<p class=\"product__size__tag\">size :</p>";
          echo "<div class=\"select product__size\"><select aria-label=\"Select menu example\" name='".$product_name."' id='size'>";
          echo "<option selected value=\"\">please select the size</option>";
          foreach ($size_array as $value) {
            if ($value != "u") {
              echo "<option value=\"".$value."\">".$value."</option>";
            } else {
              echo "<option value=\"u\">Default</option>";
            }
          }
          echo "</select></div></div>";
          if (!is_null($product_row['productlength'])) {
            echo "<div class=\"product__spec\">";
            echo "<p class=\"product__size__tag\">length :</p>";
            echo "<div class=\"select product__size\"><select aria-label=\"Select menu example\" name='".$product_name."' id='length'>";
            echo "<option selected value=\"\">please select the length</option>";
            foreach ($length_array as $value) {
              if ($value != "") {
                echo "<option value=\"".$value."\">".$value."</option>";
              } else {
                echo "<option value=\"u\">Default</option>";
              }
            }
            echo "</select></div></div>";
          }
          if ($product_gender != "u") {
            echo "<div class=\"product__gender__group\">";
            echo "<p class=\"product__gender__tag\">gender :</p>";
            echo "<p class=\"product__gender\">".$product_gender."</p></div>";
          }
          echo "<div class=\"product__button__group\">";
          echo "<button type=\"button\" class=\"inspect__item button__green button__hover__expand__admin\"><i class=\"fas fa-server\" aria-hidden=\"true\"></i></button>";
          echo "<button type=\"button\" class=\"add__to__cart button__blue modify__popup\" name=\"\" data-code=\"".$product_name."\" onclick=\"\"><i class=\"fas fa-edit\" aria-hidden=\"true\"></i>modify product</button>";
          echo "</div></div></div></div>";
        }
      }
    }
    $connect->close();
    ?>
  </body>
</html>
