<?php 
ob_start();
// CREATE TABLE START
$this_table = "applicant";

$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

$query = mysqli_query($con,"SELECT * FROM $this_table");
if(!$query){
// Check connection	
$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if($link === false){
	die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Attempt create table query execution
$sql = "CREATE TABLE applicant(

	applicant_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,

	job_id VARCHAR(200) NOT NULL,
	
	name VARCHAR(200) NOT NULL,

	email VARCHAR(200) NOT NULL,
	
	phone VARCHAR(200) NOT NULL,	

	about LONGTEXT NULL 
)";

if(mysqli_query($link, $sql)){
   return TRUE;
}

// Close connection
mysqli_close($link);
}
// CREATE TABLE END
// Delete Applicant TABLE	
?>