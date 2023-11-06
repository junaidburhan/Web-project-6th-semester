<?php
  session_start();
  $table = $_GET['table'];
  if($table == 't') $mytable = 'teachers';
  if($table == 'e') $mytable = 'employees';
  if($table == 'w') $mytable = 'workers';

  if($_SESSION['role'] != "guest"){
    require_once ("config.php");
    $id = $_GET['id'];
    $counter = 0;
    $emp_name = '';
    $query = mysqli_query($conn,"SELECT * FROM cards WHERE emp_id = $id LIMIT 1");
  if(mysqli_num_rows($query) > 0)
  {
      foreach ($query as $value) {
        $counter = $value['card_id'];
      }
  }
  if($counter < 6){ ?>

<!DOCTYPE html>
<html>
  <head>
      <meta charset="utf-8">
      <title> کارت هویت </title>
      <link rel="shortcut icon" href="dist/img/ku.png">
      <link rel="stylesheet" href="./dist/css/card.css">
      <link rel="stylesheet" href="./dist/css/print.css">
  </head>
  <body style="background-color: #68686a;width: 100%;height: 1050px" id="div1">
    <div class="container">
      <!--<div class="back">
        <div class="bcard">
        </div>
      </div>-->
    <div class="wrapper">
      <div class="card">

        <header>
          <img src="./dist/img/ku.png" alt="" />
          <div class="id">
                  <?php
                        $employee = mysqli_query($conn,"SELECT * FROM cards WHERE emp_id = $id");
                        if(mysqli_num_rows($employee) <= 0 ){
                            echo "<p>1</p>";
                            mysqli_query($conn,"INSERT INTO cards VALUES (null,$id,1)");
                        }
                        else
                        {
                        foreach ($employee as $value) {
                   ?>
                   <p><?php echo $value['card_id']; ?></p>

                   <?php
                    }
                  } ?>

          </div>
          <p>پوهنتون  کابل</p>

        </header>
        <aside class="aside">
             <p>Kabul --------------- University</p>
        </aside>

<?php
		if($table == 't')
			$select = mysqli_query($conn,"SELECT * FROM employees INNER JOIN rotba ON employees.rotba_id = rotba.rot_id INNER JOIN degree ON employees.degree_id = degree.deg_id INNER JOIN job ON employees.job_id = job.job_id INNER JOIN faculty ON employees.faculty_id = faculty.fac_id INNER JOIN province ON employees.province_id = province.pro_id where id = $id");
		else
			$select = mysqli_query($conn,"SELECT * FROM employees  INNER JOIN degree ON employees.degree_id = degree.deg_id INNER JOIN job ON employees.job_id = job.job_id INNER JOIN faculty ON employees.faculty_id = faculty.fac_id INNER JOIN province ON employees.province_id = province.pro_id where id = $id");	
	   foreach ($select as$value) {
        $emp_name = $value['pname'];
?>
      <section>
        <figure>
        <img src="<?php echo $value['photo']; ?>" alt="" />
        <?php 
                if($table == 't'){
                    $rotba = $value['rot_name'];
                    $rot_abr = $value['rot_abr'];
                  }
                  else{
                    $rotba = '';
                    $rot_abr = '';
                  }
         ?>
        <figcaption style="font-size:11px"><?php echo $rotba; ?> <?php echo $value['pname']; ?> <?php echo $value['plname']; ?>
          <br>
            <?php echo $value['positions']; ?>
        </figcaption>
      </figure>
      </section>
     <nav>
       <p style="text-transform:uppercase">ID:KU-<?php echo $value['fac_abr']; ?>-<?php
                   if($value['id'] < 9) echo "000".$value['id'];
                   else if ($value['id'] < 99) echo "00".$value['id'];
                   else if($value['id'] < 999) echo "0".$value['id'];
                   else echo $value['id'];
                  ?>
       </p>
     </nav>
     <footer>
      <p style="text-align:center"><?php echo $rot_abr; ?> <?php echo $value['name']; ?> <?php echo $value['lname']; ?><br><?php echo $value['en_positions']; ?></p>
        <img src="./dist/img/b.jpg" alt="" />
     </footer>
    <?php } ?>

   </div>
 </div>
 </div>

   <script src="plugins/html2pdf/dist/html2pdf.bundle.min.js"></script>
   	<script type="text/javascript">

 		var e = document.getElementById("div1")
       	html2pdf(e,{
   			margin: 0,
   			filename: '<?php echo $emp_name; ?>.pdf',
   			image:  {type: 'jpeg',quality: 0.98},
   			html2canvas: {scale: 6,logging: true,dpi: 192,letterRendering: true },
   			jsPDF: {unit:'mm',format:'letter',orientation:'portrait'}
   		});

   	</script>
 </body>
</html>

<h4 style="margin-left:10px;"> <a href="<?php echo $mytable; ?>.php" style="color:white;text-decoration:none;">بازگشت &larr;</a> </h4>
<?php
      $select =  mysqli_query($conn,"SELECT * FROM cards WHERE emp_id = $id LIMIT 1");
      $nextid = 0 ;
      foreach ($select as $key) {
        $nextid = $key['card_id'] + 1;
      }
      mysqli_query($conn,"UPDATE cards SET card_id = $nextid WHERE emp_id = $id");
?>
<?php
    }
    else {
      header("location:$mytable.php?access=error");
    }
}
else 
  { // this is for whene user is guset user
    header("location:error.php?tbl=$mytable");
  }

 ?>
