<?php

if(isset($_POST['sub'])){

	$fname=$_POST['fname'];
	$lname=$_POST['lname'];

	#combining names
	$name=$fname." ".$lname;
	
	$email=$_POST['mail'];
	$password=$_POST['pass'];

	#encrypting password using md5
	$passnew=md5($password);
	

	#connecting to host
	$conn=mysqli_connect("localhost","root",""); 

	if($conn){
		#db select
		$db=mysqli_select_db($conn,"people");

		if($db){

			#inserting values to table
			$query="INSERT INTO users (id,name,email,password) VALUES('','$name','$email','$passnew')";

			if(mysqli_query($conn,$query)){
				echo "account created";
			}
			else{
				echo "failed to insert values";
			}
		}
		else{
			echo "db error";
		}

	}
	else{
		echo "connection error";
	}
}
else{
	echo "error in processing data";

}

?>