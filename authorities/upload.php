<?php
// Include the database configuration file
require_once('../.confiq/confiq.php');
if (session_auth_check($connect, $server_url)['auth_key_valid']) {
  $statusMsg = '';
  $targetDir = "../images/";
  $fileName = basename($_FILES["file"]["name"]);
  $targetFilePath = $targetDir.$fileName;
  $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
  if (isset($_POST["submit"]) && !empty($_FILES["file"]["name"])) {
    // Allow certain file formats
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf', 'jfif');
    if (in_array($fileType, $allowTypes)) {
      // Upload file to server
      if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
        // Insert image file name into database
        $product_code = random_string();
        $insert = $connect->query("insert into producttable (pid, productname, productdescription, productprice, productqty, productdprice, productimagepath, productcode) values(NULL, '".$_REQUEST['productname']."', '".$_REQUEST['productdescription']."', ".$_REQUEST['productprice'].", ".$_REQUEST['productqty'].", ".$_REQUEST['productdprice'].", '".$fileName."', '".$product_code."')");
        if ($insert) {
          $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
        } else {
          $statusMsg = "File upload failed, please try again.".$connect->errno." : ".$fileName;
        }
      } else {
        $statusMsg = "Sorry, there was an error uploading your file.".$_FILES['file']['error'];
      }
    } else {
      $statusMsg = "Sorry, only JPG, JPEG, PNG, GIF, JFIF & PDF files are allowed to upload.";
    }
  } else {
    $statusMsg = "Please select a file to upload.";
  }
  admin_redirect($connect, $statusMsg);
} else {
  error_alert($connect, "Session restore failed at upload.php page.");
}
?>
