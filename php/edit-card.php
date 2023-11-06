<?php
  include_once("../config.php");
  $id = mysqli_real_escape_string($conn,$_POST['id']);
  $output = '';

  if($id != "")
   {
     $query =  mysqli_query($conn,"UPDATE cards SET card_id = 1 WHERE emp_id = $id");
     if($query)
     {
       $output .= 'موفقانه ویرایش گردید';
     }
     else
     {
      $output .= "خطا در سیستم";
     } 

   }
   else
   {
    $output .= "خطا در سیستم";
   } 
   echo $output;

?>
