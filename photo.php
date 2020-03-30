<?php
  // Create database connection
  require_once(".confiq/confiq.php");

  // Initialize message variable
  $msg = "";

  // If upload button is clicked ...
  if (isset($_POST['upload'])) {
  	// Get image name
  	$image = $_FILES['image']['name'];
  	// Get text
  	$image_text = $connect->real_escape_string($_POST['image_text']);

  	// image file directory
  	$target = "images/".basename($image);

  	$sql = "INSERT INTO producttable (cid, productname, productprice, productqty, productimage, productimagelink) VALUES (NULL, 'test', 0, 1, '$image', '$image_text')";
  	// execute query
  	$image_insert_result = $connect->query($sql);
    if (!$image_insert_result) {
      printf("Failed to upload image".$connect->errno);
      exit();
    }
  	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  		$msg = "Image uploaded successfully";
  	}else{
  		$msg = "Failed to upload image";
  	}
  }
  $result = $connect->query("SELECT * FROM producttable");
?>
<!DOCTYPE html>
<html>
<head>
<title>Image Upload</title>
<style type="text/css">
   #content{
   	width: 50%;
   	margin: 20px auto;
   	border: 1px solid #cbcbcb;
   }
   form{
   	width: 50%;
   	margin: 20px auto;
   }
   form div{
   	margin-top: 5px;
   }
   #img_div{
   	width: 80%;
   	padding: 5px;
   	margin: 15px auto;
   	border: 1px solid #cbcbcb;
   }
   #img_div:after{
   	content: "";
   	display: block;
   	clear: both;
   }
   img{
   	float: left;
   	margin: 5px;
   	width: 300px;
   	height: 140px;
   }
</style>
</head>
<body>
<div id="content">
  <?php
    while ($row = $result->fetch_array()) {
      echo "<div id='img_div'>";
      	echo "<img src='images/".$row['productimage']."' >";
      	echo "<p>".$row['productimagelink']."</p>";
      echo "</div>";
    }
  ?>
  <form method="POST" action="photo.php" enctype="multipart/form-data">
  	<input type="hidden" name="size" value="1000000">
  	<div>
  	  <input type="file" name="image">
  	</div>
  	<div>
      <textarea
      	id="text"
      	cols="40"
      	rows="4"
      	name="image_text"
      	placeholder="Say something about this image..."></textarea>
  	</div>
  	<div>
  		<input type="submit" name="upload" value="Submit"></input>
  	</div>
  </form>
</div>
</body>
</html>
