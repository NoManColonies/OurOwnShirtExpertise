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
      if(!empty($_FILES["file"]["name"])){
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf', 'jfif');
        if(in_array($fileType, $allowTypes)){
          if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
            $try_to_update_product = $connect->query("update producttable set productname='".$_REQUEST['productname']."', producttitle='".$_REQUEST['producttitle']."', productdescription='".$_REQUEST['productdescription']."', productprice=".$_REQUEST['productprice'].", productsize='".$_REQUEST['productsize']."', productlength='".((is_null($_REQUEST['productlength']))? "NULL" : "'".$_REQUEST['productlength']."'")."', productgender='".((is_null($_REQUEST['productgender']))? "NULL" : "'".$_REQUEST['productgender']."'")."', productdprice=".((is_null($_REQUEST['productdprice']))? "NULL" : $_REQUEST['productdprice']).", productimagepath='".$fileName."' where productcode='".$_REQUEST['productcode']."'");
            if (!$try_to_update_product) {
              $statusMsg = "File upload failed, please try again.".$connect->errno." : ".$fileName;
            }
          } else {
            $statusMsg = "Sorry, there was an error uploading your file.".$_FILES['file']['error'];
          }
        } else {
          $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, JFIF, & PDF files are allowed to upload.';
        }
      } else {
        $statusMsg = 'No file detected. proceeding... ';
        $try_to_update_product = $connect->query("update producttable set productname='".$_REQUEST['productname']."', producttitle='".$_REQUEST['producttitle']."', productdescription='".$_REQUEST['productdescription']."', productprice=".$_REQUEST['productprice'].", productsize='".$_REQUEST['productsize']."', productlength='".((is_null($_REQUEST['productlength']))? "NULL" : "'".$_REQUEST['productlength']."'")."', productgender='".((is_null($_REQUEST['productgender']))? "NULL" : "'".$_REQUEST['productgender']."'")."', productdprice=".((is_null($_REQUEST['productdprice']))? "NULL" : $_REQUEST['productdprice']).", productimagepath='".$_REQUEST['productimagepath']."' where productcode='".$_REQUEST['productcode']."'");
        if (!$try_to_update_product) {
          $statusMsg .= "Product update failed at index.php page error code : ".$connect->errno;
        }
      }
      echo $statusMsg;
    } else {
      echo "Error validating authentication key.";
    }
    $connect->close();
    ?>
  </body>
</html>
