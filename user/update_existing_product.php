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
        $retreive_distinct_product_result = $connect->query("select productname from producttable where productcode='".$_REQUEST['productcode']."'");
        if (!empty($retreive_distinct_product_result->num_rows)) {
          $product_row = $retreive_distinct_product_result->fetch_assoc();
          $retreive_all_product_result = $connect->query("select productcode from producttable where productname='".$product_row['productname']."'");
          if (!empty($retreive_all_product_result->num_rows)) {
            while ($row = $retreive_all_product_result->fetch_assoc()) {
              $query = "update producttable where productname='".$_REQUEST['productname']."', producttitle='".$title."', productdescription='".$_REQUEST['productdescription']."', productgender='".$gender."', productimagepath='".$fileName."' where productcode='".$row['productcode']."'";
              $result = $connect->query($query);
              if (!$result) {
                $statusMsg .= "Failed to update all distinct product error code : ".$connect->errno." query : ".$query;
              }
            }
            $query = "update producttable set productprice=".$_REQUEST['productprice'].", productdprice=".$dprice.", productsize=".$size.", productlength=".$length." where productcode='".$_REQUEST['productcode']."'";
            $try_to_update_product = $connect->query($query);
            if (!$try_to_update_product) {
              $statusMsg .= "Product update failed at index.php page error code : ".$connect->errno." query : ".$query;
            }
          }
        } else {
          $statusMsg = "Failed to update the rest of the product";
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
    $retreive_distinct_product_result = $connect->query("select productname from producttable where productcode='".$_REQUEST['productcode']."'");
    if (!empty($retreive_distinct_product_result->num_rows)) {
      $product_row = $retreive_distinct_product_result->fetch_assoc();
      $retreive_all_product_result = $connect->query("select productcode from producttable where productname='".$product_row['productname']."'");
      if (!empty($retreive_all_product_result->num_rows)) {
        while ($row = $retreive_all_product_result->fetch_assoc()) {
          $query = "update producttable where productname='".$_REQUEST['productname']."', producttitle='".$title."', productdescription='".$_REQUEST['productdescription']."', productgender='".$gender."', productimagepath='".$_REQUEST['productimagepath']."' where productcode='".$row['productcode']."'";
          $result = $connect->query($query);
          if (!$result) {
            $statusMsg .= "Failed to update all distinct product error code : ".$connect->errno." query : ".$query;
          }
        }
        $query = "update producttable set productprice=".$_REQUEST['productprice'].", productdprice=".$dprice.", productsize=".$size.", productlength=".$length." where productcode='".$_REQUEST['productcode']."'";
        $try_to_update_product = $connect->query($query);
        if (!$try_to_update_product) {
          $statusMsg .= "Product update failed at index.php page error code : ".$connect->errno." query : ".$query;
        }
      }
    } else {
      $statusMsg = "Failed to update the rest of the product";
    }
  }
  echo $statusMsg;
} else {
  echo "Error validating authentication key.";
}
$connect->close();
?>
