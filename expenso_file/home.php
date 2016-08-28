<!DOCTYPE html>
<html lang="en">
<head>
  <title>Expenso Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script type="text/javascript">
			  $(document).ready(function(){
				    $('.button').click(function(){
				        var clickBtnValue = $(this).val();
				        console.log(clickBtnValue);
				        var ajaxurl = 'delete.php',
				        data =  {'action': clickBtnValue};
				        $.post(ajaxurl, data, function (response) {
				            // Response div goes here.
				           // alert("action performed successfully");
				        	console.log(ajaxurl);
				        	location.reload();
				        	});
				    });
			
				});
						
  </script>
</head>
<body>
<?php include 'session.php'; ?>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Expenso</a>
    </div>
   
    <ul class="nav navbar-nav navbar-right">
       <li class="dropdown active">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span><?php echo $login_session_user_name; ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </li>
      </ul>
  </div>
</nav>

<div class="jumbotron ">
  <h1 class="text-center">EXPENSO</h1>
  <p class="text-center">We take care of your expenses and income calculations...</p>
</div>

<div class="jumbotron ">
  <h1 class="text-center">Your balance is : <?php include 'getBalance.php'; ?> <?php echo "<strong>".$login_session_user_currency."</strong> ".$total; ?></h1>
</div>
  
<div class="container">
	<div class="row text-center">
		<button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#income"><span class="glyphicon glyphicon-plus"></span><br>Income</button>
		<button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#expense"><span class="glyphicon glyphicon-minus"></span><br>Expense</button>
	</div>
  <div class="row">
		  	<table class="table table-striped">
		    <thead>
		      <tr>
		        <th>Transaction ID: </th>
		        <th>Description of your expense/income</th>
		        <th>Amount</th>
		        <th>Date</th>
		        <th>Category</th>
		      </tr>
		    </thead>
		    <tbody>
		      
		  	<?php 
		    	
		  	
		  	if ($conn->connect_error) {
		  		die("Connection failed: " . $conn->connect_error);
		  	}
		  	 
		  	//$sql = "SELECT T_id,user_id,source,amount,t_date,t_type,cat_id FROM transaction where user_id=".$login_session_userid." order by t_date";
		  	$sql = "SELECT T_id,user_id,source,amount,t_date,t_type,name FROM transaction INNER JOIN category ON transaction.cat_id = category.cat_id where transaction.user_id=".$login_session_userid." order by t_date desc,T_id desc";
		  	$result = $conn->query($sql);
		  	 
		  	if ($result->num_rows > 0) {
		  		// output data of each row
		  		while($row = $result->fetch_assoc()) {
		  			if ($row["t_type"] == "E"){
		  				echo "<tr class=\"danger\">";
		  			}else {echo "<tr class=\"success\">";}
		  			
		  			echo "<td>".$row["T_id"]."</td>";
		  			echo "<td>".$row["source"]."</td>";
		  			echo "<td>".$row["amount"]."</td>";
		  			echo "<td>".$row["t_date"]."</td>";
		  			echo "<td>".$row["name"]."</td>";
		  			echo "<td><button type=\"button\" class=\"button btn btn-warning\" value=\"".$row["T_id"]."\" /><span class=\"glyphicon glyphicon-trash\"></span></button></td>";
		//   			echo "T_id: ".$row["T_id"]." source: ".$row["source"]." amout: ".$row["amount"]."<br>";
		  			echo "</tr>";
		  		}
		  	} else {
		  		echo "No user found";
		  	}
		  
		    	
		    	?>
		    </tbody>
		    </table>
    </div>
    <div class="modal fade" id="income" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Your Income</h4>
        </div>
        <form method="post" action="add.php">
        <div class="modal-body">
          <table class="table">
          	<tbody>
          		<tr>
          		<td>Source of Income: </td>
          		<td><input type="text" name="inputSource" class="form-control" placeholder="Source of Income" required></td>
          		</tr>
          		<tr>
          		<td>Amount: </td>
          		<td><input type="text" name="inputAmount" class="form-control" placeholder="Amount" required></td>
          		</tr>
          		<tr>
          		<td>Date: </td>
          		<td><input type="date" name="inputDate" class="form-control" placeholder="Date of income" required></td>
          		</tr>
          		<tr>
          		<td><label for="cat">Category: </label></td>
          		<td><select class="form-control" name="inputCat">
          			
			        <?php 
				        $sql = "SELECT cat_id,name FROM category";
				        $result = $conn->query($sql);
				        
				        if ($result->num_rows > 0) {
				        	// output data of each row
				        	while($row = $result->fetch_assoc()) {
				        		echo "<option value=\"".$row["cat_id"]."\">".$row["name"]."</option>";
				        	}
				        } else {
				        	echo "No user found";
				        }
			        ?>
			      </select>
			    </td>
          		
      
          		</tr>
          	</tbody>
          </table>
                   
        </div>
        <div class="modal-footer">
        <button class="btn btn-success" type="submit">Add</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        </form>
      </div>
      </div>
      </div>
   
    <div class="modal fade" id="expense" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Your Expense</h4>
        </div>
        <form method="post" action="exp.php">
        <div class="modal-body">
          <table class="table">
          	<tbody>
          		<tr>
          		<td>Where did you spend your Money:  </td>
          		<td><input type="text" name="inputSource" class="form-control" placeholder="Place where you spent money" required></td>
          		</tr>
          		<tr>
          		<td>Amount: </td>
          		<td><input type="text" name="inputAmount" class="form-control" placeholder="Amount" required></td>
          		</tr>
          		<tr>
          		<td>Date: </td>
          		<td><input type="date" name="inputDate" class="form-control" placeholder="Date of expenditure" required></td>
          		</tr>
          		<tr>
          		<td><label for="cat">Category: </label></td>
          		<td><select class="form-control" name="inputCat">
          			<option value="0">Choose Category</option>
			        <?php 
				        $sql = "SELECT cat_id,name FROM category";
				        $result = $conn->query($sql);
				        
				        if ($result->num_rows > 0) {
				        	// output data of each row
				        	while($row = $result->fetch_assoc()) {
				        		echo "<option value=\"".$row["cat_id"]."\">".$row["name"]."</option>";
				        	}
				        } else {
				        	echo "No user found";
				        }
			        ?>
			      </select>
			    </td>
          		
      
          		</tr>
          	</tbody>
          </table>
                   
        </div>
        <div class="modal-footer">
        <button class="btn btn-danger" type="submit">Spent</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        </form>
      </div>
      
      
    </div>
  </div>
  
</div>

<?php include 'closedb.php'; ?>
</body>
</html>


