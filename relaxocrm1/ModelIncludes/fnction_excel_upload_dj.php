<?php /* Developer: Ehtesham Mehmood Site: PHPCodify.com Script: Import Excel to MySQL using PHP and Bootstrap File: import.php */ // Including database connections require_once 'db_con.php';



if(isset($_POST["submit_file"])) {
	$file = $_FILES["file"]["tmp_name"];
	$file_open = fopen($file,"r");
	while(($csv = fgetcsv($file_open, 1000, ",")) !== false) {
		$employee_name = $csv[0];
		$employee_designation = $csv[1];
		$employee_salary = $csv[2];
		$stmt = $DBcon->prepare("INSERT INTO employee (employee_name,employee_designation,employee_salary) VALUES(:employee_name, :employee_designation, :employee_salary)");
		$stmt->bindparam(':employee_name', $employee_name);
		$stmt->bindparam(':employee_designation', $employee_designation);
		$stmt->bindparam(':employee_salary', $employee_salary);
		$stmt->execute();
	}
}

echo "CSV Imported Successfully";
?>