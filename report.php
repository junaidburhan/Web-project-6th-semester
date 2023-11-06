<?php
    ob_start();
  if(isset($_POST['table'])){
    include("config.php");
    $table = $_POST['table'];
    $rotba = $_POST['rotba'];
    $degree = $_POST['degree'];
    $faculty = $_POST['faculty'];
    $job = $_POST['job'];
    $r = '';
    $d = '';
    $f = '';
    $j = '';
    if($rotba == "*") $r = "rot_abr NOT LIKE '*'";
    else   $r = "rot_abr LIKE '$rotba'";

    if($degree == "*") $d = "deg_name NOT LIKE '*'";
    else   $d = "deg_name LIKE '$degree'";

    if($faculty == "*") $f = "fac_abr NOT LIKE '*'";
    else   $f = "fac_abr LIKE '$rotba'";

    if($job == "*") $j = "job_name NOT LIKE '*'";
    else   $j = "job_name LIKE '$job'";
 ?>
    <div class="col-md-12" id="print1">
       <button type="button" class="btn active" style="color:blue" onclick="Print()"> چاپ کردن </button>
    </div>
   <div class="col-md-12">
      <table class="table" style="  text-align: center !important">
        <tr>
          <th class="text-center">آی دی</th>
          <th class="text-center">اسم</th>
          <th class="text-center">تخلص</th>
          <th class="text-center">اسم پدر</th>
          <?php 
                if ($table =='workers' OR $table == 'employees' OR $table =='*') {
                    echo "  ";
                }
                else
                {
                  echo "<th class='text-center'>رتبه علمی</th>";
                }
           ?>
          <th class="text-center">موقف</th>
          <th class="text-center">درجه تحصیل</th>
          <th class="text-center">وظیفه</th>
          <th class="text-center">پوهنحٔی</th>
          <th class="text-center">تاریخ استخدام</th>
        </tr>
    <?php
          $q  = '';
          if ($table == 'teachers') {
              $q = mysqli_query($conn,"SELECT * FROM employees INNER JOIN rotba ON employees.rotba_id = rotba.rot_id INNER JOIN degree ON employees.degree_id = degree.deg_id INNER JOIN job ON employees.job_id = job.job_id INNER JOIN faculty ON employees.faculty_id = faculty.fac_id INNER JOIN province ON employees.province_id = province.pro_id WHERE $r AND $d AND  $f  AND  $j AND role = 't'   ORDER BY id DESC");
          }
          else if($table == 'employees')
          {
              $q = mysqli_query($conn,"SELECT * FROM employees INNER JOIN degree ON employees.degree_id = degree.deg_id INNER JOIN job ON employees.job_id = job.job_id INNER JOIN faculty ON employees.faculty_id = faculty.fac_id INNER JOIN province ON employees.province_id = province.pro_id WHERE $d AND  $f  AND  $j AND role = 'e'   ORDER BY id DESC");
          }
          else if($table == 'workers')
          {

              $q = mysqli_query($conn,"SELECT * FROM employees INNER JOIN degree ON employees.degree_id = degree.deg_id INNER JOIN job ON employees.job_id = job.job_id INNER JOIN faculty ON employees.faculty_id = faculty.fac_id INNER JOIN province ON employees.province_id = province.pro_id WHERE $d AND  $f  AND  $j AND role = 'e'   ORDER BY id DESC");
          }
          else
          { 
              $q = mysqli_query($conn,"SELECT * FROM employees INNER JOIN degree ON employees.degree_id = degree.deg_id INNER JOIN job ON employees.job_id = job.job_id INNER JOIN faculty ON employees.faculty_id = faculty.fac_id INNER JOIN province ON employees.province_id = province.pro_id WHERE $d AND  $f  AND  $j   ORDER BY id DESC");
          }
            if(mysqli_num_rows($q)  > 0){
            foreach ($q as $value) {
    ?>
               <tr>
                   <td style="text-transform:uppercase">ku-<?php echo $value['fac_abr']; ?>-<?php
                         if($value['id'] <= 9) echo "000".$value['id'];
                         else if ($value['id'] <= 99) echo "00".$value['id'];
                         else if($value['id'] <= 999) echo "0".$value['id'];
                         else echo $employee['id'];
                  ?></td>
                  <td><?php echo $value['pname']; ?></td>
                  <td><?php echo $value['plname']; ?></td>
                  <td><?php echo $value['fname']; ?></td>
                  <?php 
                        if ($table =='workers' OR $table == 'employees' OR $table =='*') {
                            echo "";
                        }
                        else
                        {
                          echo "<td>".$value['rot_name']."</td>";
                        }
                   ?>
                  <td><?php echo $value['positions']; ?></td>
                  <td><?php echo $value['deg_name']; ?></td>
                  <td><?php echo $value['job_name']; ?></td>
                  <td><?php echo $value['fac_name']; ?></td>
                  <td><?php echo $value['hire_date']; ?></td>
               </tr>
   <?php
                }
              }
              else
              {
                ?>
                <tr class="text-center">
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th class="text-danger" > نتیجه ای وجود ندارد ! </th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>

                </tr>
          <?php
            }
          ?>
      </table>
   </div>

   <div class="col-md-12 print" id="print">
     <a href="reports.php" style="margin-right:20px;">&larr; بازگشت </a>
   </div>


  <script type="text/javascript">
    const p = document.querySelector("#print");
    const p1 = document.querySelector("#print1");
      function Print(){
        p.style.display = "none";
        p1.style.display = "none";
        window.print();
        window.setTimeout(sh(), 2000);
      }
      function sh()
      {
        p.style.display = "inline";
        p1.style.display = "inline";
      }

  </script>
<!-- end of teachers -->
<?php 
      }
      else
        header('location:reports.php');
?>
<?php
    $content = ob_get_contents();
    ob_get_clean();
    include("index.php");
?>