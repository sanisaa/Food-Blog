<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){

if(!empty($_POST["mail"]) && !empty($_POST["pass"])){
	
	$email=$_POST['mail'];
	$password=$_POST['pass'];

	$passmd5=md5($password);

	$conn=mysqli_connect("localhost","root","");

	if($conn){
		$db=mysqli_select_db($conn,"people");

		#fetching data from database with given sign in details
		$query="SELECT * FROM users WHERE email='$email' AND password='$passmd5'";
		$result=mysqli_query($conn,$query);

		if($result){
			$num_rows=mysqli_num_rows($result);

			if($num_rows==0){
				echo "no results found";
			}
			else if($num_rows==1){
				$datarow=mysqli_fetch_array($result, MYSQLI_ASSOC);
				$name=$datarow['name'];
				$email=$datarow['email'];

				#$datarow=id=>1 name=>abc email=> .........
				
?>
			
<?php
				
				session_start();
				// Store data in session variables
                $_SESSION["loggedin"] = true;
                $_SESSION["id"] = $datarow['id'];
                $_SESSION["name"] = $name;                           
                header("location:home.html");
			
			

			}
			else{
				echo "no user found with given information";

			}
		}
		else{
			echo "no results found!";
		}


	}
	else{
		echo "error in connection";
	}



}
else{
	echo "email and password both required to sign in";
}

}
else{
	echo "error!go to home page to sign in!";
}

?>