<?php
	session_start();
  include_once("../config.php");
  // sleep(5);
    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $password = Sha1(mysqli_real_escape_string($conn,$_POST['password']));
  	$output = "";
    if($username != "" AND $password != "" ){
      	$users = mysqli_query($conn,"SELECT * FROM users WHERE username = '$username' AND password = '$password' LIMIT 1");
      	if(mysqli_num_rows($users) > 0 )
      	{
      		$_SESSION['login']="ok";
					$_SESSION['username'] = '';
					$_SESSION['role'] = '';
					$_SESSION['image'] = '';
      	      foreach ($users as $user) {
      	          $_SESSION['username'] = $user['username'];
      	          $_SESSION['role'] = $user['role_type'];
      	          $_SESSION['image'] = $user['photo'];
      	      }
      	}
      	else
      	{
          	$output .= "نام یا پسورد شما اشتباه است";
         	}
    }
    else
    {
        $output .="نام و پسورد ضروری میباشد";
    }
	echo $output;
?>
