<?php
  ob_start();
  include("config.php");
  session_start();
  session_write_close();
  if($_SESSION['role'] != "guest")  {
 ?>

<div class="col-md-12">
  <div class="row">

    <div class="col-md-12">
      <h3 style="margin-right: 30px"> بخش گزارشات </h3>
    </div>

     <div class="col-md-8" style="margin-right: 90px;margin-top: 20px">
        <div class="row">
          <form action="report.php" method="POST">
            
            <div class="col-md-12">                
              <div class="col-md-1" style="padding:3px" >
                <b>جدول </b>
              </div>
              <div class="col-md-6">
                <select class="form-control" name="table" style="padding:3px">
                  <option value="*">*</option>
                  <option value="teachers">استادان</option>
                  <option value="employees">کارمندان</option>
                  <option value="workers">کارگران</option>
                </select>
              </div>
            </div>

            <div class="col-md-12">
              <div class="col-md-1" style="padding:3px;margin-top:10px">
                <b>رتبه علمی  </b>
              </div>
              <div class="col-md-6" style="margin-top:10px">
                <select class="form-control" name="rotba" style="padding:3px">
                  <option value="*">*</option>
                  <?php
                  $q = mysqli_query($conn,"SELECT * FROM rotba");
                    foreach ($q as $value) {
                  ?>
                  <option value="<?php echo $value['rot_abr']; ?>"><?php echo $value['rot_name']; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            
            <div class="col-md-12">
              <div class="col-md-1" style="padding:3px;margin-top:10px">
                  <b>درجه تحصیل </b>
              </div>
              <div class="col-md-6" style="margin-top:10px">
                <select class="form-control mt-2" name="degree" style="padding:3px">
                  <option value="*">*</option>
                  <?php
                      $q = mysqli_query($conn,"SELECT * FROM degree");
                      foreach ($q as $value) {
                   ?>
                   <option value="<?php echo $value['deg_name']; ?>"><?php echo $value['deg_name']; ?></option>
                 <?php } ?>
                </select>
              </div>
            </div>
            
            <div class="col-md-12">
              <div class="col-md-1 " style="padding:3px;margin-top:10px">
                  <b>پوهنحٔی </b>
              </div>
              <div class="col-md-6" style="margin-top:10px">
                <select class="form-control mt-2" name="faculty" style="padding:3px">
                  <option value="*">*</option>
                  <?php
                        $q = mysqli_query($conn,"SELECT * FROM faculty");
                        foreach ($q as $value) {
                   ?>
                   <option value="<?php echo $value['fac_abr']; ?>"><?php echo $value['fac_name']; ?></option>
                 <?php } ?>
                </select>
              </div>
            </div>

            <div class="col-md-12">
              <div class="col-md-1" style="padding:3px;margin-top:10px">
                  <b>وظیفه </b>
              </div>
              <div class="col-md-6" style="margin-top:10px">
                <select class="form-control mt-2" name="job" style="padding:3px">
                  <option value="*">*</option>
                  <?php
                        $q = mysqli_query($conn,"SELECT * FROM job");
                        foreach ($q as $value) {
                   ?>
                   <option value="<?php echo $value['job_name']; ?>"><?php echo $value['job_name']; ?></option>
                 <?php } ?>
                </select>
              </div>
            </div>

              <div class="col-md-1" style="padding:3px">
              </div>
              <div class="col-md-7" style="margin-top:10px;margin-right: 20px">
                <input type="submit" name="" value="تهیه گزارش"  class="btn btn-primary">
              </div>

          </form>
      </div>
     </div>

  </div>
</div>



</div>
 <?php
  $content = ob_get_contents();
  ob_get_clean();
  include("index.php");
}else {
  header("location:index.php");
}
?>
