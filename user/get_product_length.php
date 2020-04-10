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
    if (!empty($retreive_distinct_product_result->num_rows)) {
      echo "<option selected>Please select the length</option>";
      while ($product_row = $retreive_distinct_product_result->fetch_assoc()) {
        echo "<option value=\"".$product_row['productlength']."\">".$product_row['productlength']."</option>";
      }
    } else {
      echo "<option selected>Please select the length</option>";
      echo "<option value=\"u\">Default</option>";
    }
    $connect->close();
    ?>
  </body>
</html>
