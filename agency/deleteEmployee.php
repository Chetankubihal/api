<?php
/* Database connection start */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vbridge";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());

/* Database connection end */


$data_ids = $_REQUEST['data_ids'];
$data_id_array = explode(",", $data_ids); 
if(!empty($data_id_array)) {
	foreach($data_id_array as $id) {
		$sql = "DELETE FROM agency_employees ";
		$sql.=" WHERE employeeEmail = '".$id."'";
		$query=mysqli_query($conn, $sql) or die("employee-delete.php: delete employees");
		
	}
}
?>