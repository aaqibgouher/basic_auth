<!-- we have done all things same as register file, i will comment there only where it is needed. -->
<?php include "header.php";?>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	try{

		$user_email = trim($_REQUEST['email']);		/*we are just taking the email and pass while login*/
		$user_pass = trim($_REQUEST['pass']);

		if(!$user_email) throw new Exception("Email is required !");	/*checking that email and pass is there or not .*/
		if(!$user_pass) throw new Exception("Password is required !");
		
    	$result = mysqli_query($con,"select * from users where email = '$user_email' and password = '$user_pass'");			/*we are checking that the email and pass that user has entered , is matching with the users table data or not . */
    	$user = mysqli_fetch_assoc($result);		/*it will store the matched array.*/
    	if(!$user) throw new Exception("Correct Email is required !");		/*if user array is true means means email or pass both are true.*/

		if($result){		
			$message = "Successfully Logged-In !";
		}else{
			$error = "Error : ".mysqli_error($con);
		}

	}catch(Exception $e){
		$error = $e->getMessage();
	}
}

?>

<div class="container">
	<h1 style="text-align: center;">Login form </h1>
	<div class="row">
		<div class="col-sm-4 col-sm-offset-4 my-div">
			<?php if($error){
				echo '<div class="alert alert-danger">'.$error.'</div>';
			}?>
			<?php if($message):?>
				<div class="alert alert-success"><?php echo $message;?></div>
			<?php endif;?>

			<form action="login.php" method="post">
				
				<div class="form-input">
				    <label for="email">Email :</label><br>
				    <input type="email" class="form-control" id="email" placeholder="Enter Your Email" name="email" required><br>
			  	</div>
				<div class="form-input">
					<label for="pass">Password:</label><br>
				    <input type="password" class="form-control" id="password" placeholder="Enter Your Password" name="pass" required>
				</div><br>
				<p>If You have not registered then <a href="register.php">Click to Register</a></p>
				<button class="btn btn-primary">Submit</button>
			</form>
		</div>
	</div>
</div>
<?php include "footer.php";?>