<?php

function reArrayUplodedFiles(&$file_post) {
    $file_ary = array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);
    for ($i=0; $i<$file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }
    return $file_ary;
}

function uploadPic($file, $name, $target_dir = "assets/images/users/", $isThumbnl = false){
	$msg = '';
	$target_file = $target_dir . basename($file["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

	//// Check if image file is a actual image or fake image ///
	$check = getimagesize($file["tmp_name"]);
	if($check !== false){
		$uploadOk = 1;
	}else {
		$msg .= "File is not an image. ";
		$uploadOk = 0;
	}

	//// Check file size ////
	if($file["size"] > 500000) {
		$msg .= "Sorry, your file is too large (max 200 KB). ";
		$uploadOk = 0;
	}

	//// Allow certain file formats ////
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG") {
		$msg .= "Sorry, only JPG, PNG images are allowed. ";
		$uploadOk = 0;
	}

	//// Check if $uploadOk is set to 0 by an error ////
	if ($uploadOk == 0) {
		return $msg;
	//// if everything is ok, try to upload file ////
	} else {
		if(move_uploaded_file($file["tmp_name"], $target_dir.$name.'.'.'png')) {
			if ($isThumbnl) {
			    $thumb_beforeword = "thumb";
			    $arr_image_details = getimagesize($target_dir.$name.'.'.'png'); // pass id to thumb name
			    $original_width = $arr_image_details[0];
			    $original_height = $arr_image_details[1];
			    $thumbnail_height = 70;
			    $thumbnail_width = 70;
			    if ($original_width > $original_height) {
			    	$thumbnail_width = $original_width * $thumbnail_height / $original_height;
			        $new_width = $thumbnail_width;
			        $new_height = intval($original_height * $new_width / $original_width);
			    } else {
			    	$thumbnail_height = $original_height * $thumbnail_width / $original_width;
			        $new_height = $thumbnail_height;
			        $new_width = intval($original_width * $new_height / $original_height);
			    }
			    $dest_x = intval(($thumbnail_width - $new_width) / 2);
			    $dest_y = intval(($thumbnail_height - $new_height) / 2);
		        $new_image = imagecreatetruecolor($thumbnail_width, $thumbnail_height);
		        if ($old_image = ImageCreateFromPNG($target_dir.$name.'.'.'png')) {
		        	imagecopyresized($new_image, $old_image, $dest_x, $dest_y, 0, 0, $new_width, $new_height, $original_width, $original_height);
		        	ImagePNG($new_image, $target_dir.$name.'-th.'.'png');
		        }else{
		        	copy($target_dir.$name.'.'.'png', $target_dir.$name.'-th.'.'png');
		        }
			}
			return false;
		}else {
			return "Sorry, there was an error uploading your Picture. ";
		}
	}
}