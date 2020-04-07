<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    require_once('../.confiq/auth_confiq.php');
    if (add_to_cart($connect, $listmanager, $_REQUEST['q'], 1, true)) {
      echo "q";
    } else {
      echo "";
    }
    $listmanager->close();
    $connect->close();
    ?>
  </body>
</html>
