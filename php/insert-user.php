<?php
      include_once("../config.php");
      $username = mysqli_real_escape_string($conn,$_POST['username']);
      $password =Sha1(mysqli_real_escape_string($conn,$_POST['password']));
      $role = mysqli_real_escape_string($conn,$_POST['role']);
      $output = '';

      if($username != "" AND $password != "" AND $_FILES['photo']['name'] != "")
      {
        $q = mysqli_query($conn,"SELECT username FROM users WHERE username = '$username'");
          if(mysqli_num_rows($q) > 0)
          {
            $output .="این کاربر در سیستم وجود دارد";
          }
          else
          {
              $img_name = $_FILES['photo']['name'];
              $img_explode = explode('.',$img_name);
              $img_ext = end($img_explode);
              $extensions = ['png','jpeg','jpg','JPG','JPEG','PNG'];
              $img = "uploads/users/".time().rand(1,99999).basename($_FILES['photo']['name']);
              $path = "php/".$img;

              if(in_array($img_ext,$extensions))
              {
                if(move_uploaded_file($_FILES['photo']['tmp_name'],$img))
                {
                  $q1 = mysqli_query($conn,"INSERT INTO users VALUES (null,'$username','$password','$role','$path')");
                  if($q)
                    $output .="موفقانه ذخیره گردید";
                  else
                      $output .= "خطا در سیستم";
                }
                else
                {
                  $output .= "خطا در سیستم";
                }
              }
              else
              {
                  $output .="فارمت عکس ( jpg , jpeg , png ) باشد";
              }
          }
      }
      else
      {
          $output .= "تمام معلومات ضروری میباشد";
      }

      echo $output;
?>
