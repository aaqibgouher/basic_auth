<?php include "header.php";?>		<!--imported header file-->
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){		/*if the method is post , then only.*/
	try{
		/* whatever the user will enter , it will store in either $_POST or in $_REQUEST, sp we are just taking the values from it and storing it here.trim will remove white spaces etc*/
		$user_name = trim($_REQUEST['name']);			
		$user_email = trim($_REQUEST['email']);
		$user_pass = trim($_REQUEST['pass']);
		$user_confirm_pass = trim($_REQUEST['confirm_pass']);

		if(!$user_name) throw new Exception("Name is required !");		/*if user doest not enter their name, then it will throw error*/
		if(!$user_email) throw new Exception("Email is required !");	/*if user doest not enter their email , then it will throw error*/
		if(!$user_pass) throw new Exception("Password is required !");		/*same woth password*/
		if($user_pass != $user_confirm_pass) throw new Exception("Password is not matched !");	/*here we are checking that , whatever the password user has entered , is matching with it or not*/
		

    	$result =  mysqli_query($con, "select * from users where email = '$user_email'");		/*This function is used to execute SQL command .here we are bringing that data whose email is equal to user_email*/
    	$user = mysqli_fetch_assoc($result);		/*used to fetch all the selected data. This function returns row as an associative array, a numeric array, or both. This function returns FALSE if there are no more rows.so basically user here is array*/

    	if($user) throw new Exception("Email has already taken !");		/*if it is true , means it has got the array , means user is already exist in the Db , means user has already registered.So we will show error.and if there is not any match , then it will go further.*/
    	
		$result = mysqli_query($con, "insert into users values (null,'$user_name','$user_email','$user_pass');");		/*If there is not match , means its for new registration, then we will register them.*/
		if($result){
			$message = "Successfully Registered ! <br>";	/*if result will true, we will tell store the msg in variable . else will show error.*/
		}else{
			$error = "Error : ".mysqli_error($con);
		}
	}catch(Exception $e){		/*this catch part, all of the things that we are throwing , will come here without executing further.*/
		$error = $e->getMessage();		/*we will store the error in variable*/
	}
}
?>
<div class="container-fluid">
	
	<h1 style="text-align: center;">Registration form </h1>
	<div class="row">
		<div class="col-sm-4 col-sm-offset-4 my-div">
			<?php if($error){		/*here we are showing that error or msg.Here we have used type of method to show output , first is like that*/
				echo '<div class="alert alert-danger">'.$error.'</div>';
			}?>
			<?php if($message):?>		<!--other is like that-->
				<div class="alert alert-success"><?php echo $message;?></div>
			<?php endif;?>

			<form action="register.php" method="post">		<!--action is on the same page, and method is post-->
				<div class="form-input">
				    <label for="name">Name :</label><br>
				    <input type="text" class="form-control" id="name" placeholder="Enter Your Name" name="name" required><br>
			  	</div>
				<div class="form-input">
				    <label for="email">Email :</label><br>
				    <input type="email" class="form-control" id="email" placeholder="Enter Your Email" name="email" required><br>
			  	</div>
				<div class="form-input">
					<label for="pass">Password:</label><br>
				    <input type="password" class="form-control" id="password" placeholder="Enter Your Password" name="pass" required>
				</div><br>
				<div class="form-input">
					<label for="confirm_pass">Confirm Password:</label><br>
				    <input type="password" class="form-control" id="confirm_password" placeholder="Enter Your Confirm Password" name="confirm_pass" required>
				</div>
				<br>
				<p>If You have already registered then <a href="login.php">Click to Loggin</a></p>
				<button class="btn btn-primary">Submit</button>
			</form>
		</div>
	</div>
</div>

<?php include "footer.php";?>		<!--included footer file here. So in this project we have divided our codes into multiple files , because it is easy to find the error .and whenever we want change the files,we can go to that file separately and can change .No need to mixed all the things together.so this registration page, same login page is also there.-->