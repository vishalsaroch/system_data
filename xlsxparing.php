<pre><?php
include('../wp-load.php');
global $wpdb;

ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

require_once("SimpleXLSX.php");

echo '<h1>Upload XLSX Data File </h1>'; 

if (isset($_FILES['file'])) {
	
	if ( $xlsx = SimpleXLSX::parse( $_FILES['file']['tmp_name'] ) ) {

		$dim = $xlsx->dimension();
		$cols = $dim[0];
		$columns = array(0, 1, 2, 3);
		$sheetCount=1;
		// foreach ( $xlsx->sheetNames() as $ks => $spreadSheet ) {
		// 	// print_r($ks);
		// 	// echo gettype($spreadSheet);
		// 	// echo $spreadSheet;
		// 	for ($i = 0; $i <= $sheetCount; $i ++) {
				foreach ( $xlsx->rows() as $k => $r ) {
					// if (isset($spreadSheet[$i][0])) {
						if (in_array($k+1, $columns)) {}else{
								// echo "$r[2]";
								// $posts = $wpdb->get_results("SELECT * FROM results where Participation = '$r[2]' AND Year = '$r[0]'");
								// foreach ($posts as $row){
								// 	if($row->Participation == $r[2]){
								// 		echo "data is already registed";
								// 	}else{
										// print_r($r);
										$sql = "INSERT INTO results (`Years`, `Name`,`Participation`,`Venue`, `Dates`, `Snatch`, `WtCat`, `C&J`, `Total`, `Place` ) 
													VALUES ('$r[0]', '$r[1]', '$r[2]', '$r[3]', '$r[4]', '$r[5]', '$r[6]', '$r[7]', '$r[8]', '$r[9]')";
										$perform_query = $wpdb->query($sql) or die(mysql_error());
										if($perform_query){
											echo "Result inserted Successfully";
									// 	}
									// }
								
								}
							// }
								
						// }
					// }
				// }
			}
			// echo  $sheetCount;
			// echo "<pre>";
			// print_r($spreadSheet);
			// echo "<pre>";
			// $sheetCount++;
			
		}
	} else {
		echo SimpleXLSX::parseError();
	}
}
echo '<h2>Upload form</h2>
<form method="post" enctype="multipart/form-data">
*.XLSX <input type="file" name="file"  />&nbsp;&nbsp;<input type="submit" value="Parse" />
</form>';
