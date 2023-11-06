<?php
      include_once("../config.php");
      $name = mysqli_real_escape_string($conn,$_POST['name']);
      $ename = mysqli_real_escape_string($conn,$_POST['ename']);
      $lname = mysqli_real_escape_string($conn,$_POST['lname']);
      $elname = mysqli_real_escape_string($conn,$_POST['elname']);
      $fname = mysqli_real_escape_string($conn,$_POST['fname']);
      $gender = mysqli_real_escape_string($conn,$_POST['gender']);
      $status = mysqli_real_escape_string($conn,$_POST['status']);
      $phone = mysqli_real_escape_string($conn,$_POST['phone']);
      $email = mysqli_real_escape_string($conn,$_POST['email']);
      $province = mysqli_real_escape_string($conn,$_POST['province']);
      $rotba = mysqli_real_escape_string($conn,$_POST['rotba']);
      $position = mysqli_real_escape_string($conn,$_POST['position']);
      $eposition = mysqli_real_escape_string($conn,$_POST['eposition']);
      $job = mysqli_real_escape_string($conn,$_POST['job']);
      $faculty = mysqli_real_escape_string($conn,$_POST['faculty']);
      $hire_date = mysqli_real_escape_string($conn,$_POST['hire_date']);
      $birth_date = mysqli_real_escape_string($conn,$_POST['birth_date']);
      $degree = mysqli_real_escape_string($conn,$_POST['degree']);
      $output = '';

 if($name !="" AND $ename !="" AND $lname !="" AND $elname !="" AND $fname !="" AND $phone !="" AND $email !="" AND $hire_date !="" AND $birth_date !="" AND $position !="" AND $eposition !="" AND $_FILES['photo']['name'] !="")
 {
   if(filter_var($email,FILTER_VALIDATE_EMAIL))
   {
      $q = mysqli_query($conn,"SELECT name FROM employees WHERE email = '$email' LIMIT 1");
      if(mysqli_num_rows($q) > 0)
      {
          $output .= "این ایمیل آدرس در سیستم وجود دارد";
      }
      else
      {
          $img_name = $_FILES['photo']['name'];
          $img_explode = explode('.',$img_name);
          $img_ext = end($img_explode);
          $extensions = ['png','jpeg','jpg','PNG','JPG','JPEG'];
          if(in_array($img_ext,$extensions))
          {
                $img = "uploads/teachers/".time().rand(1,99999).basename($_FILES['photo']['name']);
                $path = "php/".$img;
                if(move_uploaded_file($_FILES['photo']['tmp_name'],$img))
                {
                  $query = mysqli_query($conn,"INSERT INTO employees VALUES (null,'$name','$lname','$fname','$ename','$elname','$gender','$email','$phone','$status','$birth_date','$hire_date','$position','$eposition','t','$faculty','$job','$degree','$province','$rotba','$path')");
                    if($query)
                    {
                      $output .="موفقانه دخیره گردید";
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

          }
          else
          {
            $output .= "فارمت عکس   ( jpg , png , jpeg ) باشد";
          }
      }
    }
    else
    {
        $output .= "ایمیل آدرس شما درست نمیباشد";
    }

 }
 else
 {
  $output .= "تمام معلومات ضروری میباشد";
 }
  echo $output;
 ?>
