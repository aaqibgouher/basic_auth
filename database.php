<?php
	
include "config.php";		/*imported config file here*/

$con = mysqli_connect($HOSTNAME,$USERNAME,$PASSWORD,$DATABASE);		/*connecting to the DB , and passing the hostname, username , pass, Db as a parameter.*/

if(!$con){			/*if the connection is not true , means $con doesnt form then it will die, means it will go out from here*/
	// die("Error : ".mysqli_connect_error());
	die("Database is not connected");		/*simply we are showing it as our output.*/
}
