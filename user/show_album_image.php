<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    require_once('../.confiq/confiq.php');
    $retreive_distinct_product_result = $connect->query("select distinct productimagepath from producttable");
    if (!empty($retreive_distinct_product_result->num_rows)) {
      while ($product_row = $retreive_distinct_product_result->fetch_assoc()) {
        echo "<div class=\"album__img__container\">";
        echo "<img src=\"pic/".$product_row['productimagepath']."\" alt=\"\">";
        echo "<span></span>";
        echo "<p>".$product_row['productimagepath']."</p>";
        echo "</div>";
      }
    } else {
      echo "<p class=\"cart__no__result\">No image available.</p>";
    }
    ?>
  </body>
</html>
