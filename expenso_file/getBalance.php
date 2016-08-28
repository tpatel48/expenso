
 <?php 

//     	echo $login_session_user_name;
    	
    	$total=0.00;
    	
    	$sum_query = "SELECT amount,t_type from transaction where user_id=".$login_session_userid;
    	$sum_result = $conn->query($sum_query);
    	if ($sum_result->num_rows > 0) {
    		// output data of each row
    		while($row = $sum_result->fetch_assoc()) {
    			if ($row["t_type"] == "E"){
    				$total=$total - $row["amount"];
    			}else{$total = $total + $row["amount"];}
    		}
    	} else {
    		echo "No Transactions Found";
    	}
    	
 ?>