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
      echo "<div class=\"product__container\">";
      echo "<img src=\"images/".$product_imagepath."\">";
      echo "<div class=\"desc\">";
      echo "<p class=\"product__name\">".$product_name."</p>";
      echo "<p class=\"product__detail\">".$product_title."</p>";
      echo "<div class=\"product__price__group\">";
      echo "<p class=\"product__price__tag\">price :</p>";
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
      echo "</div></div>";
      echo "<div class=\"spec\">";
      echo "<div class=\"product__spec\">";
      echo "<p class=\"product__size__tag\">size :</p>";
      foreach ($size_array as $value) {
        if ($value != "u") {
          echo "<p class=\"product__size\">".$value."</option>";
        }
      }
      echo "</div>";
      $check_bit = false;
      foreach ($length_array as $value) {
        if ($value != "" && $value != "u") {
          if (!$check_bit) {
            echo "<div class=\"product__spec\">";
            echo "<p class=\"product__size__tag\" style=\"margin-right: 0\">length :</p>";
            $check_bit = true;
          }
          echo "<p class=\"product__size\">".$value."\"</option>";
        }
      }
      if ($check_bit) {
        echo "</div>";
      }
      if ($product_gender != "u") {
        echo "<div class=\"product__gender__group\">";
        echo "<p class=\"product__gender__tag\">gender :</p>";
        echo "<p class=\"product__gender\">".$product_gender."</p></div>";
      }
      echo "<div class=\"product__button__group\">";
      echo "<button type=\"button\" class=\"inspect__item button__green button__hover__expand__admin stock_update_trigger\"><i class=\"fas fa-server\" aria-hidden=\"true\"></i></button>";
      echo "<button type=\"button\" class=\"add__to__cart button__blue modify__popup\" name=\"\" data-name=\"".$product_name."\" onclick=\"\"><i class=\"fas fa-edit\" aria-hidden=\"true\"></i>modify product</button>";
      echo "</div></div></div></div>";
    }
  }
}
$connect->close();
?>
