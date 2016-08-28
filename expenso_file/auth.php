<?php
   include("config.php");
   session_start();
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {
    		// username and password sent from form
    	
    		$myusername = mysqli_real_escape_string($conn,$_POST["inputEmail"]);
    		$mypassword = mysqli_real_escape_string($conn,$_POST["inputPassword"]);
    	
    		$sql = "SELECT user_id,name FROM user WHERE email='".$myusername."' and password='".$mypassword."'";
    		$result = mysqli_query($conn,$sql);
    		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    		$count = mysqli_num_rows($result);
    	
			if($count == 1) {
    			$_SESSION['login_user_email'] = $myusername;
    			
    			header("location: home.php");
    		}else {
    			header("location: expenso.php");
    		}
    	}
?>

<?php include 'closedb.php'; ?>