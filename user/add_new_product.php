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
        $title = (empty($_REQUEST['producttitle']))? "NULL" : "'".$_REQUEST['producttitle']."'";
        $size = (empty($_REQUEST['productsize']))? "'u'" : "'".$_REQUEST['productsize']."'";
        $length = (empty($_REQUEST['productlength']))? "NULL" : "'".$_REQUEST['productlength']."'";
        $gender = (empty($_REQUEST['productgender']))? "'u'" : "'".$_REQUEST['productgender']."'";
        $dprice = (empty($_REQUEST['productdprice']))? "NULL" : $_REQUEST['productdprice'];
        $query = "insert into producttable (pid, productname, producttitle, productdescription, productprice, productsize, productlength, productgender, productqty, productdprice, productimagepath, productcode) values(NULL, '".$_REQUEST['productname']."', ".$title.", '".$_REQUEST['productdescription']."', ".$_REQUEST['productprice'].", ".$size.", ".$length.", ".$gender.", 0, ".$dprice.", '".$fileName."', '".$product_code.($line_count + 1)."')";
        $insert = $connect->query($query);
        if (!$insert) {
          $statusMsg = "File upload failed, please try again.".$connect->errno." : ".$fileName." query : ".$query;
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
    $title = (empty($_REQUEST['producttitle']))? "NULL" : "'".$_REQUEST['producttitle']."'";
    $size = (empty($_REQUEST['productsize']))? "'u'" : "'".$_REQUEST['productsize']."'";
    $length = (empty($_REQUEST['productlength']))? "NULL" : "'".$_REQUEST['productlength']."'";
    $gender = (empty($_REQUEST['productgender']))? "'u'" : "'".$_REQUEST['productgender']."'";
    $dprice = (empty($_REQUEST['productdprice']))? "NULL" : $_REQUEST['productdprice'];
    $query = "insert into producttable (pid, productname, producttitle, productdescription, productprice, productsize, productlength, productgender, productqty, productdprice, productimagepath, productcode) values(NULL, '".$_REQUEST['productname']."', ".$title.", '".$_REQUEST['productdescription']."', ".$_REQUEST['productprice'].", ".$size.", ".$length.", ".$gender.", 0, ".$dprice.", '".$_REQUEST['productimagepath']."', '".$product_code.($line_count + 1)."')";
    $insert = $connect->query($query);
    if (!$insert) {
      $statusMsg = "Failed to upload product error code : ".$connect->errno." query : ".$query;
    }
  }
  echo $statusMsg;
} else {
  echo "Failed to check for authentication key.";
}
$connect->close();
?>
