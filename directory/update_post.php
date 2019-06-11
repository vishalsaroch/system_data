<?php include("config.php");?>
<?php include("user-session.php");?>
<?php

	$title=$_POST['ad_title'];
	$price=$_POST['price'];
	$sub_Categories=$_POST['sub_Categories'];
	$Categories=$_POST['Category'];
	$Condition=$_POST['Condition'];
	$price=$_POST['price'];
	$ad_for=$_POST['ad_for'];
	$Brand=$_POST['Brand'];
	$ad_description=$_POST['ad_description'];
	$address=$_POST['address'];
	$city=$_POST['city'];
	$show_ad=$_POST['show_ads'];
	$date=date("Y/m/d");
	$image1 = addslashes(file_get_contents($_FILES["image1"]["tmp_name"]));
	$image2 = addslashes(file_get_contents($_FILES["image2"]["tmp_name"]));
	$image3 = addslashes(file_get_contents($_FILES["image3"]["tmp_name"]));
	$image4 = addslashes(file_get_contents($_FILES["image4"]["tmp_name"]));
	 
		$sql = "INSERT INTO `post` (`title`, `price`, `categories`, `sub-categories`, `condition`, `ad-for`, `brand`, `discription`, `image1`, `image2`, `image3`, `image4`, `address`, `userid`, `city` , `current_time`, `show_ads`) VALUES ('$title', '$price', '$Categories', '$sub_Categories', '$Condition', '$ad_for' , '$Brand', '$ad_description', '$image1', '$image2', '$image3', '$image4', '$address', '$email', '$city', '$date', '$show_ad')";
        if ($conn->query($sql) === TRUE) {
			echo "ad posted successfully";
		   echo "<script>location='db-all-listing.php'</script>";
				exit();
		    	} else {
		    	echo "Error: " . $sql . "<br>" . $conn->error;
				}
			// }
			    $conn->close(); 
			   
		   
?>