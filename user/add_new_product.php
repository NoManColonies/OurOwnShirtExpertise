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
      $statusMsg = "";
      $targetDir = "../images/";
      $fileName = basename($_FILES["file"]["name"]);
      $targetFilePath = $targetDir.$fileName;
      $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
      if (isset($_POST["submit"]) && !empty($_FILES["file"]["name"])) {
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf', 'jfif');
        if (in_array($fileType, $allowTypes)) {
          if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
            $product_list_result = $connect->query("select * from producttable");
            $line_count = $product_list_result->num_rows;
            $product_code = random_string();
            $insert = $connect->query("insert into producttable (pid, productname, producttitle, productdescription, productprice, productsize, productlength, productgender, productqty, productdprice, productimagepath, productcode) values(NULL, '".$_REQUEST['productname']."', '".$_REQUEST['producttitle']."', '".$_REQUEST['productdescription']."', ".$_REQUEST['productprice'].", ".((is_null($_REQUEST['productsize']))? "NULL" : "'".$_REQUEST['productsize']."'").", ".((is_null($_REQUEST['productlength']))? "NULL" : "'".$_REQUEST['productlength']."'").", ".((is_null($_REQUEST['productgender']))? "NULL" : "'".$_REQUEST['productgender']."'").", 0, ".((is_null($_REQUEST['productdprice']))? "NULL" : $_REQUEST['productdprice']).", '".$fileName."', '".$product_code.($line_count + 1)."')");
            if (!$insert) {
              $statusMsg = "File upload failed, please try again.".$connect->errno." : ".$fileName;
            }
          } else {
            $statusMsg = "Sorry, there was an error uploading your file.".$_FILES['file']['error'];
          }
        } else {
          $statusMsg = "Sorry, only JPG, JPEG, PNG, GIF, JFIF & PDF files are allowed to upload.";
        }
      } else {
        $product_list_result = $connect->query("select * from producttable");
        $line_count = $product_list_result->num_rows;
        $product_code = random_string();
        $insert = $connect->query("insert into producttable (pid, productname, producttitle, productdescription, productprice, productsize, productlength, productgender, productqty, productdprice, productimagepath, productcode) values(NULL, '".$_REQUEST['productname']."', '".$_REQUEST['producttitle']."', '".$_REQUEST['productdescription']."', ".$_REQUEST['productprice'].", ".((is_null($_REQUEST['productsize']))? "NULL" : "'".$_REQUEST['productsize']."'").", ".((is_null($_REQUEST['productlength']))? "NULL" : "'".$_REQUEST['productlength']."'").", ".((is_null($_REQUEST['productgender']))? "NULL" : "'".$_REQUEST['productgender']."'").", 0, ".((is_null($_REQUEST['productdprice']))? "NULL" : $_REQUEST['productdprice']).", '".$_REQUEST['productimagepath']."', '".$product_code.($line_count + 1)."')");
      }
      echo $statusMsg;
    } else {
      echo "Failed to check for authentication key.";
    }
    $connect->close();
    ?>
  </body>
</html>
