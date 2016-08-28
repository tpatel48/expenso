<!DOCTYPE html>
<html lang="en">
<head>
  <title>Expenso</title>
 
</head>
<body>
<?php
	   include('config.php');
   		session_start();
   		if($_SERVER["REQUEST_METHOD"] == "POST") {
   			// username and password sent from form
   			if(!isset($_SESSION['login_user_email'])){
   				header("location:expenso.php");
   				mysqli_close($conn);
   			} 
   			$inputsource = mysqli_real_escape_string($conn,$_POST["inputSource"]);
   			$inputamount = mysqli_real_escape_string($conn,$_POST["inputAmount"]);
   			$inputdate = mysqli_real_escape_string($conn,$_POST["inputDate"]);
   			$inputcat = mysqli_real_escape_string($conn,$_POST["inputCat"]);
//    			echo "1 ".$inputsource."2 ".$inputamount."3 ".$inputdate."4 ".$inputcat;
			$session_userid =  $_SESSION['login_user_id'];
   			 

			$sql = "Insert into transaction(user_id,source,amount,t_date,t_type,cat_id) values($session_userid,'$inputsource',$inputamount,'$inputdate','I',$inputcat)"; 
			if ($conn->query($sql) === TRUE) {
				$message = "sucessfully added";
				echo "<script type='text/javascript'>alert('$message');</script>";
				header("location: home.php");
			} else {
				$message = "sorry something went wrong. Try again !";
				echo "<script type='text/javascript'>alert('$message');</script>";
				echo "Error: " . $sql . "<br>" . $conn->error;
				//header("location: home.php");
			}
			
			
			
			//echo "$sql";
//  			$result = mysqli_query($conn,$sql);
//   			$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
//     			$count = mysqli_num_rows($result);
   			 
//     			if($count == 1) {
//     				$_SESSION['login_user_email'] = $myusername;
   				 
//     				header("location: home.php");
//    			}else {
//    				header("location: expenso.php");
//    			}
   		}
?>
<?php include 'closedb.php'; ?>
</body>
</html>