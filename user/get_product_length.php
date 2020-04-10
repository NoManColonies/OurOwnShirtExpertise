<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    require_once('../.confiq/confiq.php');
    $retreive_distinct_product_result = $connect->query("select productlength from producttable where productname='".$_REQUEST['q']."' and productsize='".$_REQUEST['s']."'");
    echo "<option selected>Please select the length</option>";
    if (!empty($retreive_distinct_product_result->num_rows)) {
      $check_bit = false;
      while ($product_row = $retreive_distinct_product_result->fetch_assoc()) {
        if ($product_row['productlength'] != "u" && $product_row['productlength'] != "") {
          echo "<option value=\"".$product_row['productlength']."\">".$product_row['productlength']."</option>";
        } else if (!$check_bit) {
          $check_bit = true;
          echo "<option value=\"u\">Default</option>";
        }
      }
    } else {
      echo "<option value=\"u\">Default</option>";
    }
    $connect->close();
    ?>
  </body>
</html>
