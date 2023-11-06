<?php
    session_start();
    $s = session_unset();
    if($s)
      header("location:login.php");
 ?>
