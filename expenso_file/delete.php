<?php include('config.php'); ?>
<?php
if (isset($_POST['action'])) {
// 	echo $_POST['action'];
	$sql = "DELETE FROM transaction WHERE T_id=".$_POST['action'];

    // use exec() because no results are returned
    $conn->query($sql);
    echo "Transaction ".$_POST['action']." deleted successfully";
	exit;
}else{echo "something went wrong. !! try again";
exit;
}


?>
<?php include 'closedb.php'; ?>