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
        $title = (empty($_REQUEST['producttitle']))? "NULL" : "'".$_REQUEST['producttitle']."'";
        $size = (empty($_REQUEST['productsize']))? "'u'" : "'".$_REQUEST['productsize']."'";
        $length = (empty($_REQUEST['productlength']))? "NULL" : "'".$_REQUEST['productlength']."'";
        $gender = (empty($_REQUEST['productgender']))? "'u'" : "'".$_REQUEST['productgender']."'";
        $dprice = (empty($_REQUEST['productdprice']))? "NULL" : $_REQUEST['productdprice'];
        $query = "update producttable set productname='".$_REQUEST['productname']."', producttitle=".$title.", productdescription='".$_REQUEST['productdescription']."', productprice=".$_REQUEST['productprice'].", productsize=".$size.", productlength=".$length.", productgender=".$gender.", productdprice=".$dprice.", productimagepath='".$fileName."' where productcode='".$_REQUEST['productcode']."'";
        $try_to_update_product = $connect->query($query);
        if (!$try_to_update_product) {
          $statusMsg = "Product update failed at index.php page error code : ".$connect->errno." query : ".$query;
        }
      } else {
        $statusMsg = "Sorry, there was an error uploading your file.".$_FILES['file']['error'];
      }
    } else {
      $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, JFIF, & PDF files are allowed to upload.';
    }
  } else {
    $title = (empty($_REQUEST['producttitle']))? "NULL" : "'".$_REQUEST['producttitle']."'";
    $size = (empty($_REQUEST['productsize']))? "'u'" : "'".$_REQUEST['productsize']."'";
    $length = (empty($_REQUEST['productlength']))? "NULL" : "'".$_REQUEST['productlength']."'";
    $gender = (empty($_REQUEST['productgender']))? "'u'" : "'".$_REQUEST['productgender']."'";
    $dprice = (empty($_REQUEST['productdprice']))? "NULL" : $_REQUEST['productdprice'];
    $query = "update producttable set productname='".$_REQUEST['productname']."', producttitle=".$title.", productdescription='".$_REQUEST['productdescription']."', productprice=".$_REQUEST['productprice'].", productsize=".$size.", productlength=".$length.", productgender=".$gender.", productdprice=".$dprice.", productimagepath='".$_REQUEST['productimagepath']."' where productcode='".$_REQUEST['productcode']."'";
    $try_to_update_product = $connect->query($query);
    if (!$try_to_update_product) {
      $statusMsg = "Product update failed at index.php page error code : ".$connect->errno." query : ".$query;
    }
  }
  echo $statusMsg;
} else {
  echo "Error validating authentication key.";
}
$connect->close();
?>
