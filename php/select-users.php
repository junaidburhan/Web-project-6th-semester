<?php
	session_start();
	if($_SESSION['role'] =="superadmin"){
	include("../config.php");
	$output ='';
	$per_page = 10;

	 if (isset($_POST['page'])) {
	 	 $page = $_POST['page'];
	 }
	 else {
	 	$page = 1;
	 }
	 $start_from = ($page-1) * $per_page;

    $users = mysqli_query($conn,"SELECT * FROM users ORDER BY id DESC LIMIT $start_from,$per_page");
    if(mysqli_num_rows($users) > 0){
		$output = '
						<table class="table table-bordered" id="tbl" style="margin-top:10px !important">
							<tr>
                  <th>آی دی</th>
                  <th>اسم</th>
                  <th>نقش</th>
                  <th>عکس</th>
                  <th>حذف</th>
							</tr>
							';
			foreach ($users as $user)
			 {
							$id = "";
			        if($user['id'] <= 9) $id = "000".$user['id'];
			        else if ($user['id'] <= 99) $id = "00".$user['id'];
			        else if($user['id'] <= 999) $id = "0".$user['id'];
			        else $id = $user['id'];

							$output .= '<tr>
              <td>U'.$id.'</td>
              <td>'.$user['username'].'</td>
              <td>'.$user['role_type'].'</td>
              <td><img src="'.$user['photo'].'" width="30" height="30"></td>
              <td>
    							<a href="#deleteModal" class="dropdown-item" data-toggle="modal" onclick="deleteFunc('.$user['id'].')"> <i class="fa fa-trash text-danger" style="font-size:19px"></i></a><br>
              </td>
            </tr>';
				}
				$output .='</table>';
			$record = mysqli_query($conn , "SELECT * FROM users");
			$number_record = mysqli_num_rows($record);
			$total= ceil($number_record/$per_page);
			$prev = ($page -1 == 0)? 1 : $page-1;
			$next = ($page +1 > $total) ? $total : $page + 1;

			$output .='
							 <ul class="pagination pagination-sm">
							 	<li>
									<a href="users.php?page='.$prev.'"> &laquo; قبلی</a>
								</li>
								';
								 		for ($i = 1 ; $i <= $total ; $i++) {
								 			$output .='
								 			<li><a href="users.php?page='.$i.'">'.$i.'</a></li>
								 			';
								 		 }
								 		 $output .='
										<li><a href="users.php?page='.$next.'">بعدی &raquo;</a></li>
							 </ul>
			';
  }
	else
	{
		$output .= "<h4>هیج کاربر در سیستم وجود ندارد</h4>";
	}
	echo $output;
 }
?>
