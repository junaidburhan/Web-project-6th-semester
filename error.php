<?php
  ob_start();
  ?>
<div class="col-md-12">
  <a href="<?php echo $_GET['tbl'].".php"; ?>"> &larr; بازگشت</a>
  <h4 class="text-danger text-center">شما اجازه دسترسی را ندارید !</h4>
</div>

 <?php
  $content = ob_get_contents();
  ob_get_clean();
  include('index.php');
 ?>
