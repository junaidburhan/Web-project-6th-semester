<?php
      include_once("../config.php");
      $id = mysqli_real_escape_string($conn,$_POST['id']);
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
      $position = mysqli_real_escape_string($conn,$_POST['position']);
      $eposition = mysqli_real_escape_string($conn,$_POST['eposition']);
      $job = mysqli_real_escape_string($conn,$_POST['job']);
      $faculty = mysqli_real_escape_string($conn,$_POST['faculty']);
      $hire_date = mysqli_real_escape_string($conn,$_POST['hire_date']);
      $birth_date = mysqli_real_escape_string($conn,$_POST['birth_date']);
      $degree = mysqli_real_escape_string($conn,$_POST['degree']);
      $output = '';

 if($name !="" AND $ename !="" AND $lname !="" AND $elname !="" AND $fname !="" AND $phone !="" AND $hire_date !="" AND $birth_date !="" AND $position !="" AND $eposition !="")
 {
	if($email != '')
	{
		if(filter_var($email,FILTER_VALIDATE_EMAIL))
		{
			$q = mysqli_query($conn,"SELECT name FROM employees WHERE email = '$email' AND id != $id LIMIT 1");
				if(mysqli_num_rows($q) > 0)
				{
					$output .= "این ایمیل آدرس در سیستم وجود دارد";
				}
				else
				{
					if($_FILES['photo']['name'] !="")
					{
						$img_name = $_FILES['photo']['name'];
						$img_explode = explode('.',$img_name);
						$img_ext = end($img_explode);
						$extensions = ['png','jpeg','jpg','JPG','JPEG','PNG'];
						if(in_array($img_ext,$extensions))
						{
							$imgDelete = "";
							$sql = mysqli_query($conn,"SELECT photo FROM employees WHERE id = $id");
							foreach ($sql as  $value) {
								$imgDelete = $value['photo'];
							}
							$img = "uploads/workers/".time().rand(1,99999).basename($_FILES['photo']['name']);
							$path = "php/".$img;
							if(move_uploaded_file($_FILES['photo']['tmp_name'],$img))
							{
								$query = mysqli_query($conn,"UPDATE employees SET pname ='$name',fname='$fname',plname='$lname',name='$ename',lname='$elname',gender='$gender',email='$email',phone='$phone',status='$status',birth_date='$birth_date',hire_date='$hire_date', positions = '$position', en_positions = '$eposition',province_id = $province, faculty_id = $faculty, job_id = $job,degree_id = $degree ,photo ='$path' WHERE id = $id ");
								if($query)
								{
									unlink(substr($imgDelete,4));
									$output .="موفقانه ویرایش گردید";
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
							$output .= "فارمت عکس ( jpg , jpeg , png ) باشد";
						}
					}
					else
					{
						$query = mysqli_query($conn,"UPDATE employees SET pname ='$name',fname='$fname',plname='$lname',name='$ename',lname='$elname',gender='$gender',email='$email',phone='$phone',status='$status',birth_date='$birth_date',hire_date='$hire_date', positions = '$position', en_positions = '$eposition',province_id = $province, faculty_id = $faculty, job_id = $job,degree_id = $degree WHERE id = $id ");
						if($query)
								$output .="موفقانه ویرایش گردید";
						else
								$output .= "خطا در سیستم";
					}
					
				}
		}
		else
		{
			$output .='ایمیل آدرس شما درست نمیباشد';
		}
	}
	else
	{
		if($_FILES['photo']['name'] != "")
        {
		  $img_name = $_FILES['photo']['name'];
          $img_explode = explode('.',$img_name);
          $img_ext = end($img_explode);
          $extensions = ['png','jpeg','jpg','JPG','JPEG','PNG'];
          if(in_array($img_ext,$extensions))
          {
                $imgDelete = "";
                $sql = mysqli_query($conn,"SELECT photo FROM employees WHERE id = $id");
                foreach ($sql as  $value) {
                    $imgDelete = $value['photo'];
                }
                $img = "uploads/workers/".time().rand(1,99999).basename($_FILES['photo']['name']);
                $path = "php/".$img;
                if(move_uploaded_file($_FILES['photo']['tmp_name'],$img))
                {
                  $query = mysqli_query($conn,"UPDATE employees SET pname ='$name',fname='$fname',plname='$lname',name='$ename',lname='$elname',gender='$gender',email=null,phone='$phone',status='$status',birth_date='$birth_date',hire_date='$hire_date', positions = '$position', en_positions = '$eposition',province_id = $province, faculty_id = $faculty, job_id = $job,degree_id = $degree ,photo ='$path' WHERE id = $id ");
                    if($query)
                    {
                      unlink(substr($imgDelete,4));
                      $output .="موفقانه ویرایش گردید";
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
            $output .= "فارمت عکس ( jpg , jpeg , png ) باشد";
          }
        }
        else
         {
           $query = mysqli_query($conn,"UPDATE employees SET pname ='$name',fname='$fname',plname='$lname',name='$ename',lname='$elname',gender='$gender',email=null,phone='$phone',status='$status',birth_date='$birth_date',hire_date='$hire_date', positions = '$position', en_positions = '$eposition',province_id = $province, faculty_id = $faculty, job_id = $job,degree_id = $degree WHERE id = $id ");
           if($query)
               $output .="موفقانه ویرایش گردید";
           else
               $output .= "خطا در سیستم";
        }
	}
	 
        
 }
 else
 {
  $output .= "تمام معلومات ضروری میباشد";
 }
  echo $output;
 ?>
