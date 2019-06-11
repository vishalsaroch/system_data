<?php
     $file_result = "";
    
     if ($_FILES["fileToUpload"]["error"] > 0)
     {
     $_file_result .= "No file uploaded or invalid file!";
     $_file_result .= "Error Code:" . $_FILES["fileToUpload"]["error"] . "<br>";
	 echo $file_result;
     } else {
    
     $file_result .=
     "Upload: " . $_FILES["fileToUpload"]["name"] . "<br>" .
     "Type: " . $_FILES["fileToUpload"]["type"] . "<br>" .
     "Size: " . ($_FILES["fileToUpload"]["size"] / 1024) . "Kb<br>" .
     "Temp file: " . $_FILES["fileToUpload"]["tmp_name"] . "<br>" .
    
     move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],"../images/" . $_FILES["fileToUpload"]["name"]);
    
     $file_result .= "File Upload succesful!";
	 echo $file_result;
     }
?>﻿