<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    require_once('../.confiq/confiq.php');
    $retreive_product_result = $connect->query("select * from producttable");
    if (!empty($retreive_product_result->num_rows)) {
      while ($product_row = $retreive_product_result->fetch_assoc()) {
        echo "<div class=\"product__container\">";
        echo "<img src=\"images/".$product_row['productimagepath']."\">";
        echo "<div class=\"desc\">";
        echo "<p class=\"product__name\">".$product_row['productname']."</p>";
        echo "<p class=\"product__detail\">".$product_row['producttitle']."</p>";
        echo "<div class=\"product__price__group\">";
        echo "<p class=\"product__price__tag\">price :</p>";
        if (is_null($product_row['productdprice'])) {
          echo "<p class=\"product__price\">".$product_row['productprice']."฿</p>";
        } else {
          echo "<p class=\"product__price discounted\">".$product_row['productprice']."฿</p>";
          echo "<p class=\"product__discounted__price\">".$product_row['productdprice']."฿</p>";
        }
        echo "</div></div>";
        echo "<div class=\"spec\">";
        if ($product_row['productsize'] != "u") {
          echo "<div class=\"product__spec\">";
          echo "<p class=\"product__size__tag\">size :</p>";
          $size_array = explode(',', $product_row['productsize']);
          foreach ($size_array as $value) {
            echo "<p class=\"product__size\">".$value."</p>";
          }
          echo "</div>";
        }
        if (!is_null($product_row['productlength'])) {
          echo "<div class=\"product__spec\">";
          echo "<p class=\"product__size__tag\">length :</p>";
          $length_array = explode(',', $product_row['productlength']);
          foreach ($length_array as $value) {
            echo "<p class=\"product__size\">".$value."</p>";
          }
          echo "</div>";
        }
        if ($product_row['productgender'] != "u") {
          echo "<div class=\"product__gender__group\">";
          echo "<p class=\"product__gender__tag\">gender :</p>";
          echo "<p class=\"product__gender\">".$product_row['productgender']."</p></div>";
        }
        echo "<div class=\"product__button__group\">";
        echo "<button type=\"button\" class=\"inspect__item button__green button__hover__expand__admin\"><i class=\"fas fa-server\" aria-hidden=\"true\"></i></button>";
        echo "<button type=\"button\" class=\"add__to__cart button__blue modify__popup\" name=\"add\" data-code=\"".$product_row['productcode']."\" onclick=\"\"><i class=\"fas fa-edit\" aria-hidden=\"true\"></i>modify product</button>";
        echo "</div></div></div>";
      }
    }
    $connect->close();
    ?>
  </body>
</html>
