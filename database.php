<?php
	
include "config.php";

$con = mysqli_connect($HOSTNAME,$USERNAME,$PASSWORD,$DATABASE);

if(!$con){
	// die("Error : ".mysqli_connect_error());
	die("Database is not connected");
}
