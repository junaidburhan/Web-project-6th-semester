<?php
      include_once("../config.php");
      $id = mysqli_real_escape_string($conn,$_POST['id']);
      $output = '';
      $img = '';

      $query = mysqli_query($conn,"SELECT photo FROM users WHERE id = $id");
      if(mysqli_num_rows($query) > 0)
      {
        foreach ($query as $value) {
          $img = $value['photo'];
        }
        unlink(substr($img,4));
      }
      $query1 = mysqli_query($conn,"DELETE FROM users WHERE id = $id");
      if($query1)
            $output .="موفقانه حذف شد";
      else
          $output .="خطا در سیستم";

      echo $output;
?>
