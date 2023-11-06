<?php
	include("../config.php");
	$output ='';

  $teachers = mysqli_query($conn,"SELECT teachers.id,pname,plname,teach_id,card_id FROM teachers INNER JOIN teacher_card ON teachers.id = teacher_card.teach_id ORDER BY id DESC");
  if(mysqli_num_rows($teachers) > 0){
		$output = '
						<table class="table table-bordered table-striped" id="tbl" style="margin-top:10px !important">
							<tr>
                  <th>آی دی</th>
                  <th>اسم</th>
                  <th>تخلص</th>
                  <th>تعداد کارت چاپ شده</th>
                  <th>ویرایش</th>
							</tr>
							';
			foreach ($teachers as $teacher)
			 {
							$output .= '<tr>
              <td>ku-'.$teacher['id'].'</td>
              <td>'.$teacher['pname'].'</td>
              <td>'.$teacher['plname'].'</td>
              <td>'.($teacher['card_id']-1).'</td>
              <td>
                      <a href="#editModal" data-toggle="modal" class="dropdown-item" onclick="SetValues(
												'.$teacher['id'].','.$teacher['card_id'].
												')"><i class="fa fa-edit text-info" style="font-size:18px !important"></i> &nbsp;</a><br>
              </td>
              </tr>';
						}
	}
	else
	{
		$output .= "<h4 class='text-center'>هیچ کارت چاپ نشده</h4>";
	}
	echo $output;
?>
