<?php
	include("../config.php");
  $s = mysqli_real_escape_string($conn,$_POST['search']);
	$output ='';

    $workers = mysqli_query($conn,"SELECT * FROM employees INNER JOIN degree ON employees.degree_id = degree.deg_id INNER JOIN job ON employees.job_id = job.job_id INNER JOIN faculty ON employees.faculty_id = faculty.fac_id INNER JOIN province ON employees.province_id = province.pro_id   WHERE (id = '$s' OR pname LIKE '%$s%' OR name LIKE '%$s%' OR fname LIKE '%$s%' OR plname LIKE '%$s%' OR lname LIKE '%$s%' OR deg_name LIKE '%$s%' OR fac_name LIKE '%$s%' OR fac_abr LIKE '%$s%' OR fac_en_name LIKE '%$s%' OR pro_name lIKE '%$s%' OR hire_date LIKE '%$s%' OR positions LIKE '%$s%' OR en_positions LIKE '%$s%' OR job_name LIKE '%$s%'  OR phone LIKE '%$s%' OR email LIKE '%$s%' OR gender LIKE '%$s%') AND role='w' ORDER BY id DESC ");
    if(mysqli_num_rows($workers) > 0){
		$output = '
			<table class="table table-bordered table-striped" id="tbl" style="margin-top:10px !important">
				<tr>
                  <th>آی دی</th>
                  <th>اسم</th>
                  <th>تخلص</th>
                  <th>درجه تحصیل</th>
                  <th>موقف</th>
                  <th>پوهنحٔی</th>
                  <th>وظیفه</th>
                  <th>شماره تماس</th>
                  <th>تاریخ استخدام</th>
                  <th>عملیه  ها</th>
				</tr>
							';
			foreach ($workers as $worker)
			 {
							$id = "";
			        if($worker['id'] <= 9) $id = "000".$worker['id'];
			        else if ($worker['id'] <= 99) $id = "00".$worker['id'];
			        else if($worker['id'] <= 999) $id = "0".$worker['id'];
			        else $id = $worker['id'];

							$output .= '<tr>
              <td style="text-transform:uppercase">ku-'.$worker['fac_abr']."-".$id.'</td>
              <td>'.$worker['pname'].'</td>
              <td>'.$worker['plname'].'</td>
              <td>'.$worker['deg_name'].'</td>
              <td>'.$worker['positions'].'</td>
              <td>'.$worker['fac_name'].'</td>
              <td>'.$worker['job_name'].'</td>
              <td>'.$worker['phone'].'</td>
              <td>'.$worker['hire_date'].'</td>
              <td>
                <div class="dropdown">
                    <button style="background:transparent !important;border:none" class="dropdown-toggle" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <b><i class="fa fa-pencil-square text-primary" style="font-size:18px"></i></b>
                    </button>
                    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenu2" style="padding:15px !important;background:#fff !important">
                      <a href="#editModal" data-toggle="modal" class="dropdown-item" onclick="SetValues(
												'.$worker['id'].',\''
												.$worker['pname'].'\',\''
												.$worker['plname'].'\',\''
												.$worker['fname'].'\',\''
												.$worker['name'].'\',\''
												.$worker['lname'].'\',\''
												.$worker['gender'].'\',\''
												.$worker['email'].'\',\''
												.$worker['phone'].'\',\''
												.$worker['status'].'\',\''
												.$worker['birth_date'].'\',\''
												.$worker['hire_date'].'\',\''
												.$worker['province_id'].'\',\''
												.$worker['positions'].'\',\''
												.$worker['en_positions'].'\',\''
												.$worker['faculty_id'].'\',\''
												.$worker['job_id'].'\',\''
												.$worker['degree_id'].'\',\''
												.$worker['photo'].'\''.
												')"><i class="fa fa-pencil text-info" style="font-size:11px !important"></i> &nbsp; ویرایش</a><br>

											<a href="#detailsModal" class="dropdown-item" data-toggle="modal" onclick="MoreInfo('.$worker['id'].')"> <i class="fa fa-arrow-circle-left text-info" style="font-size:11px !important"></i> &nbsp; جزیٔیات بیشتر</a><br>

											<a href="cards.php?id='.$worker['id'].'&table='.$worker['role'].'" class="dropdown-item"><i class="fa fa-print text-info" style="font-size:11px !important"></i> &nbsp;  پرنت کارت هویت</a><br>

											<a href="#editCardModal" class="dropdown-item" data-toggle="modal" onclick="editCard('.$worker['id'].')"> <i class="fa fa-pencil" style="font-size:11px"></i> &nbsp; ویرایش کارت هویت </a>

										</div>
                </div>
              </td>
              </tr>';
				}
			$output .="</table>";
	}
	else
	{
    $output .= "<h5 class='text-center'>نتیجه ای دریافت نشد !</h5>";
	}
	echo $output;
?>
