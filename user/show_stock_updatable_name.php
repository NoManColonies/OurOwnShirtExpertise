<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    require_once('../.confiq/confiq.php');
    if (session_auth_check($connect)['auth_key_valid']) {
      $retreive_product_result = $connect->query("select distinct productname from producttable");
      if (!empty($retreive_product_result->num_rows)) {
        echo "<div class=\"stock_select_product\">";
        echo "<div class=\"select\">";
        echo "<select aria-label=\"Select menu example\" class=\"stock_label\" id=\"stock_label_name\">";
        if (isset($_REQUEST['q']) && $_REQUEST['q'] != "") {
          echo "<option value=\"\">please select the product</option>";
        } else {
          echo "<option selected value=\"\">please select the product</option>";
        }
        while ($product_row = $retreive_product_result->fetch_assoc()) {
          if ($product_row['productname'] == $_REQUEST['q']) {
            echo "<option selected value=\"".$product_row['productname']."\">".$product_row['productname']."</option>";
          } else {
            echo "<option value=\"".$product_row['productname']."\">".$product_row['productname']."</option>";
          }
        }
        echo "</select></div></div>";
        echo "<div class=\"stock_select_product\">
          <div class=\"select\">
            <select aria-label=\"Select menu example\" class=\"stock_label\" id=\"stock_label_size\">
              <option selected value=\"\">please select the size</option>
            </select>
          </div>
        </div>";
        echo "<div class=\"stock_select_product\">
          <div class=\"select\">
            <select aria-label=\"Select menu example\" class=\"stock_label\" id=\"stock_label_length\">
              <option selected value=\"\">please select the length</option>
            </select>
          </div>
        </div>";
        echo "<div class=\"stock_select_amount\">
          <div class=\"input__icon stock_update_input\">
            <input type=\"number\" min=\"1\" name=\"productqty\" value=\"1\" class=\"input__glow\" placeholder=\"Restock amount\">
            <div class=\"icon__snap__field\">
              <div class=\"icon__snap__field__relative\">
                <i class=\"fas fa-cubes fa-lg fa-fw input__snap\" aria-hidden=\"true\"></i>
              </div>
            </div>
          </div>
        </div>";
        echo "<button disabled class=\"button__icon button__green stock_update_button\"><i class=\"fas fa-cubes\"></i>Update stock</button>";
      } else {
        echo "<option value=\"nothing\">0 product found</option>";
      }
    } else {
      echo "";
    }
    $connect->close();
    ?>
  </body>
</html>
