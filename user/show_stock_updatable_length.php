<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    require_once('../.confiq/confiq.php');
    $retreive_product_result = $connect->query("select distinct productlength from producttable where productname='".$_REQUEST['q']."' and productsize='".$_REQUEST['s']."'");
    if (!empty($retreive_product_result->num_rows)) {
      $check_bit = false;
      echo "<option selected value=\"\">please select the length</option>";
      while ($product_row = $retreive_product_result->fetch_assoc()) {
        if ($product_row['productlength'] != "" && $product_row['productlength'] != "u") {
          echo "<option value=\"".$product_row['productlength']."\">".$product_row['productlength']."</option>";
        } else if (!$check_bit) {
          $check_bit = true;
          echo "<option value=\"u\">Default</option>";
        }
      }
    } else {
      echo "";
    }
    $connect->close();
    ?>
  </body>
</html>
