<?php
	include_once("../config.php");
    $id = mysqli_real_escape_string($conn,$_POST['id']);
	$output = "";

    $employees = mysqli_query($conn,"SELECT * FROM employees INNER JOIN degree ON employees.degree_id = degree.deg_id INNER JOIN job ON employees.job_id = job.job_id INNER JOIN faculty ON employees.faculty_id = faculty.fac_id INNER JOIN province ON employees.province_id = province.pro_id WHERE id = $id");

	foreach ($employees as $value) {
   		$id1 = "";
           if($value['id'] <= 9) $id1 = "000".$value['id'];
           else if ($value['id'] <= 99) $id1 = "00".$value['id'];
           else if($value['id'] <= 999) $id1 = "0".$value['id'];
           else $id1 = $value['id'];
		$output .= "<table><tr><th>آی دی : </th><th> &nbsp;&nbsp;&nbsp; </th><th style='text-transform:uppercase'>kpu-".$value['fac_abr']."-".$id1."<tr>".
		"<tr><th>اسم : </th><th> &nbsp; </th><th>".$value['pname']."</th></tr>".
		"<tr><th>تخلص : </th><th> &nbsp; </th><th>".$value['plname']."</th></tr>".
		"<tr><th>اسم پدر : </th><th> &nbsp; </th><th>".$value['fname']."</th></tr>".
		"<tr><th>جنسیت : </th><th> &nbsp; </th><th>".$value['gender']."</th></tr>".
		"<tr><th>حالت مدنی : </th><th> &nbsp; </th><th>".$value['status']."</th></tr>".
		"<tr><th>سکونت اصلی : </th><th> &nbsp; </th><th>".$value['pro_name']."</th></tr>".
		"<tr><th>تاریخ تولد : </th><th> &nbsp; </th><th>".$value['birth_date']."</th></tr>".
		"<tr><th>درجه تحصیل : </th><th> &nbsp; </th><th>".$value['deg_name']."</th></tr>".
		"<tr><th>موقف : </th><th> &nbsp; </th><th>".$value['positions']."</th></tr>".
		"<tr><th>پوهنحٔی : </th><th> &nbsp; </th><th>".$value['fac_name']."</th></tr>".
		"<tr><th>نوع وظیفه : </th><th> &nbsp; </th><th>".$value['job_name']."</th></tr>".
		"<tr><th>تاریخ استخدام : </th><th> &nbsp; </th><th>".$value['hire_date']."</th></tr>".
		"<tr><th>شماره تماس : </th><th> &nbsp; </th><th>".$value['phone']."</th></tr>".
		"<tr><th>ایمیل‌آدرس : </th><th> &nbsp; </th><th>".$value['email']."</th></tr></table>"
		;
    $output .= '
    <div> <img src="'.$value['photo'].'" style="float:left;margin-left:150px !important;margin-top:-290px !important" class="img img-thumbnail"  width = "100" height ="100" /> </div>';
	}
	$output .= "</table>";
	echo $output;

?>
