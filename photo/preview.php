<?php
// Include the database configuration file
require_once('../.confiq/confiq.php');

// Get images from the database
$query = $connect->query("SELECT * FROM producttable");

if($query->num_rows > 0){
    while($row = $query->fetch_assoc()){
        $imageURL = '../images/'.$row["productimagelink"];
?>
    <img src="<?php echo $imageURL; ?>" alt="" />
<?php }
}else{ ?>
    <p>No image(s) found...</p>
<?php } ?>
