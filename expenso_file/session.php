<?php
   include('config.php');
   session_start();
   
   $user_check = $_SESSION['login_user_email'];
   
   $ses_sql = mysqli_query($conn,"select user_id,name,currency from user where email = '".$user_check."'");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session_userid = $row["user_id"];
   $login_session_user_name = $row["name"];
   $login_session_user_currency = $row["currency"];
   $_SESSION['login_user_id'] = $login_session_userid;
   if(!isset($_SESSION['login_user_email'])){
      header("location:expenso.php");
      mysqli_close($conn);
   }
?>