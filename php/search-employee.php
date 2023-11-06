<?php
	include("../config.php");
	$s = mysqli_real_escape_string($conn,$_POST['search']);
	$output = '';
	$employees = mysqli_query($conn,"SELECT * FROM employees INNER JOIN degree ON employees.degree_id = degree.deg_id INNER JOIN job ON employees.job_id = job.job_id INNER JOIN faculty ON employees.faculty_id = faculty.fac_id INNER JOIN province ON employees.province_id = province.pro_id   WHERE (id = '$s' OR pname LIKE '%$s%' OR name LIKE '%$s%' OR fname LIKE '%$s%' OR plname LIKE '%$s%' OR lname LIKE '%$s%' OR deg_name LIKE '%$s%' OR fac_name LIKE '%$s%' OR fac_abr LIKE '%$s%' OR fac_en_name LIKE '%$s%' OR pro_name lIKE '%$s%' OR hire_date LIKE '%$s%' OR positions LIKE '%$s%' OR en_positions LIKE '%$s%' OR job_name LIKE '%$s%'  OR phone LIKE '%$s%' OR email LIKE '%$s%' OR gender LIKE '%$s%') AND role='e' ORDER BY id DESC ");
	if(mysqli_num_rows($employees) > 0){
		$output =  '
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
			foreach ($employees as $employee)
			 {
							$id = "";
			        if($employee['id'] <= 9) $id = "000".$employee['id'];
			        else if ($employee['id'] <= 99) $id = "00".$employee['id'];
			        else if($employee['id'] <= 999) $id = "0".$employee['id'];
			        else $id = $employee['id'];

							$output .= '<tr>
              <td style="text-transform:uppercase">ku-'.$employee['fac_abr']."-".$id.'</td>
              <td>'.$employee['pname'].'</td>
              <td>'.$employee['plname'].'</td>
              <td>'.$employee['deg_name'].'</td>
              <td>'.$employee['positions'].'</td>
              <td>'.$employee['fac_name'].'</td>
              <td>'.$employee['job_name'].'</td>
              <td>'.$employee['hire_date'].'</td>
              <td>'.$employee['phone'].'</td>
              <td>
                <div class="dropdown">
                    <button style="background:transparent !important;border:none" class="dropdown-toggle" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <b><i class="fa fa-pencil-square text-primary" style="font-size:18px"></i></b>
                    </button>
                    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenu2" style="padding:15px !important;background:#fff !important">
                      <a href="#editModal" data-toggle="modal" class="dropdown-item" onclick="SetValues(
												'.$employee['id'].',\''
												.$employee['pname'].'\',\''
												.$employee['plname'].'\',\''
												.$employee['fname'].'\',\''
												.$employee['name'].'\',\''
												.$employee['lname'].'\',\''
												.$employee['gender'].'\',\''
												.$employee['email'].'\',\''
												.$employee['phone'].'\',\''
												.$employee['status'].'\',\''
												.$employee['birth_date'].'\',\''
												.$employee['hire_date'].'\',\''
												.$employee['province_id'].'\',\''
												.$employee['positions'].'\',\''
												.$employee['en_positions'].'\',\''
												.$employee['faculty_id'].'\',\''
												.$employee['job_id'].'\',\''
												.$employee['degree_id'].'\',\''
												.$employee['photo'].'\''.
												')"><i class="fa fa-pencil text-info" style="font-size:11px !important"></i> &nbsp; ویرایش</a><br>

											<a href="#detailsModal" class="dropdown-item" data-toggle="modal" onclick="MoreInfo('.$employee['id'].')"> <i class="fa fa-arrow-circle-left text-info" style="font-size:11px !important"></i> &nbsp; جزیٔیات بیشتر</a><br>

											<a href="cards.php?id='.$employee['id'].'&table='.$employee['role'].'" class="dropdown-item"><i class="fa fa-print text-info" style="font-size:11px !important"></i> &nbsp;  پرنت کارت هویت</a><br>

											<a href="#editCardModal" class="dropdown-item" data-toggle="modal" onclick="editCard('.$employee['id'].')"> <i class="fa fa-pencil" style="font-size:11px"></i> &nbsp; ویرایش کارت هویت </a>

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
