<?php
	include("../config.php");
	$output = '';
	$per_page = 10;
	$page = (isset($_POST['page'])) ? $_POST['page'] :  1;
	$start_from = ($page - 1) * $per_page;
	$teachers = mysqli_query($conn,"SELECT * FROM employees INNER JOIN rotba ON employees.rotba_id = rotba.rot_id INNER JOIN degree ON employees.degree_id = degree.deg_id INNER JOIN job ON employees.job_id = job.job_id INNER JOIN faculty ON employees.faculty_id = faculty.fac_id INNER JOIN province ON employees.province_id = province.pro_id WHERE role ='t' ORDER BY id DESC LIMIT $start_from,$per_page");
	if(mysqli_num_rows($teachers) > 0){
		$output = '
						<table class="table table-bordered table-striped" id="tbl" style="margin-top:10px !important">
							<tr>
								<th style="font-family:">آی دی</th>
								<th>اسم</th>
								<th>تخلص</th>
								<th>درجه تحصیل</th>
								<th>موقف</th>
								<th>رتبه علمی</th>
								<th>پوهنحٔی</th>
								<th>تاریخ استخدام</th>
								<th>شماره تماس</th>
								<th>عملیه  ها</th>
							</tr>
							';
			foreach ($teachers as $teacher)
			 {
					$id = "";
			        if($teacher['id'] <= 9) $id = "000".$teacher['id'];
			        else if ($teacher['id'] <= 99) $id = "00".$teacher['id'];
			        else if($teacher['id'] <= 999) $id = "0".$teacher['id'];
			        else $id = $teacher['id'];

					$output .= '<tr>
		              <td style="text-transform:uppercase">ku-'.$teacher['fac_abr']."-".$id.'</td>
		              <td>'.$teacher['pname'].'</td>
		              <td>'.$teacher['plname'].'</td>
		              <td>'.$teacher['deg_name'].'</td>
		              <td>'.$teacher['positions'].'</td>
		              <td>'.$teacher['rot_name'].'</td>
		              <td>'.$teacher['fac_name'].'</td>
		              <td>'.$teacher['hire_date'].'</td>
		              <td>'.$teacher['phone'].'</td>
		              <td>
		                <div class="dropdown">
		                    <button style="background:transparent !important;border:none" class="dropdown-toggle" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		                      <b><i class="fa fa-pencil-square text-primary" style="font-size:18px"></i></b>
		                    </button>
		                    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenu2" style="padding:15px !important;background:#fff !important">
		                      <a href="#editModal" data-toggle="modal" class="dropdown-item" onclick="SetValues(
														'.$teacher['id'].',\''
														.$teacher['pname'].'\',\''
														.$teacher['plname'].'\',\''
														.$teacher['fname'].'\',\''
														.$teacher['name'].'\',\''
														.$teacher['lname'].'\',\''
														.$teacher['gender'].'\',\''
														.$teacher['email'].'\',\''
														.$teacher['phone'].'\',\''
														.$teacher['status'].'\',\''
														.$teacher['birth_date'].'\',\''
														.$teacher['hire_date'].'\',\''
														.$teacher['province_id'].'\',\''
														.$teacher['rotba_id'].'\',\''
														.$teacher['positions'].'\',\''
														.$teacher['en_positions'].'\',\''
														.$teacher['faculty_id'].'\',\''
														.$teacher['job_id'].'\',\''
														.$teacher['degree_id'].'\',\''
														.$teacher['photo'].'\''.
														')"><i class="fa fa-pencil text-info" style="font-size:11px !important"></i> &nbsp; ویرایش</a><br>

													<a href="#detailsModal" class="dropdown-item" data-toggle="modal" onclick="MoreInfo('.$teacher['id'].')"> <i class="fa fa-arrow-circle-left text-info" style="font-size:11px !important"></i> &nbsp; جزیٔیات بیشتر</a><br>

													<a href="cards.php?id='.$teacher['id'].'&table='.$teacher['role'].'" class="dropdown-item"><i class="fa fa-print text-info" style="font-size:11px !important"></i> &nbsp;  پرنت کارت هویت</a><br>
													<a href="#editCardModal" class="dropdown-item" data-toggle="modal" onclick="editCard('.$teacher['id'].')"> <i class="fa fa-pencil" style="font-size:11px"></i> &nbsp; ویرایش کارت هویت </a>
												</div>
		                </div>
		              </td>
		              </tr>';
								}
					$output .="</table>";
					$record = mysqli_query($conn , "SELECT * FROM employees WHERE role = 't' ");
					$number_record = mysqli_num_rows($record);
					$total= ceil($number_record / $per_page);

					$prev = ($page -1 == 0)? 1 : $page-1;
					$next = ($page +1 > $total) ? $total : $page + 1;

					$output .='
									 <ul class="pagination pagination-sm">
									 	<li>
											<a href="teachers.php?page='.$prev.'">  &laquo; قبلی</a>
										</li>
										';
										 		for ($i = 1 ; $i <= $total ; $i++) {
										 			$output .='
										 			<li><a href="teachers.php?page='.$i.'" style="color:blue">'.$i.'</a></li>
										 			';
										 		 }
										 		 $output .='
												<li><a href="teachers.php?page='.$next.'">بعدی &raquo;</a></li>
									 </ul>
					';
	}
	else
	{
		$output .= "<h4 class='text-center'>هیچ استاد در سیستم وجود ندارد</h4>";
	}
	echo $output;
?>
