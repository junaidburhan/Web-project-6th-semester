<?php
    session_start();
function getcurrentPage()
{
  $currentPage = basename($_SERVER['PHP_SELF']);
  $currentPage = pathinfo($currentPage,PATHINFO_BASENAME);
  return $currentPage;
    }
    if(isset($_SESSION['login'])){
      $currentPage = getcurrentPage();
      if (empty($currentPage)){
        $currentPage = "information";
      }
 ?>

<!DOCTYPE html>
<html>
  <head>
    <link rel="shortcut `icon`" href="dist/img/ku.png">
    <meta charset="UTF-8">
    <title>پوهنتون کابل</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="dist/css/font-awesome.min.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="plugins/iCheck/flat/purple.css">
    <link rel="stylesheet" href="plugins/morris/morris.css">
    <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="stylesheet" href="dist/fonts/fonts-fa.css">
    <link rel="stylesheet" href="dist/css/bootstrap-rtl.min.css">
    <link rel="stylesheet" href="dist/css/rtl.css">
    <script type="text/javascript" src="bootstrap/js/jquery.min.js">  </script>
    <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
    <script type="text/javascript" src="plugins/toastr/toastr.min.js"></script>
    <style>
      /* Styling for the active menu item */
      .sidebar-menu li.active {
        background-color: #f8f9fa;
        border-left: 3px solid #007bff;
      }

      .sidebar-menu li.active a {
        color: #9b0000;
      }

      .sidebar-menu li.active i {
        color: #007bff;
      }
    </style>
  </head>
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">
      <header class="main-header">
        <!-- Logo -->
        <a href="" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b style="color:aqua">KU</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b style="color:aqua">KU</b> HR </span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-right image">
              <img src="<?php echo $_SESSION['image']; ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo $_SESSION['username']; ?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> آنلاین</a>
            </div>
          </div>

    <!--search box-->
         <form class="sidebar-form">
           <div class="input-group">
             <input type="text" name="search" id="search" class="form-control" placeholder="جستجو ...">
             <span class="input-group-btn">
               <button type="button" class="btn btn-flat"><i class="fa fa-search"></i></button>
             </span>
           </div>
         </form>
    <!--end search box-->

          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">مینوی اصلی</li>

            <li <?php if($currentPage === "teachers") echo ' class="active"'; ?>>
              <a href="teachers.php">
                <i class="fa fa-book"></i> <span>استادان</span>
              </a>
            </li>
            <li >
              <a href="employees.php">
                <i class="fa fa-briefcase"></i> <span>کارمندان</span>
              </a>
            </li>
            <li >
              <a href="workers.php">
                <i class="fa fa-building-o"></i> <span>کارگران</span>
              </a>
            </li>

            <?php if($_SESSION['role'] == "superadmin"){ ?>
            <li>
              <a href="users.php">
                <i class="fa fa-user"></i> <span>کاربران</span>
              </a>
            </li>
          <?php  } ?>

          <?php if($_SESSION['role'] != "guest"){ ?>
            <li>
              <a href="reports.php">
                <i class="fa fa-info-circle"></i> <span>گزارشات</span>
              </a>
            </li>
          <?php  } ?>
<!--
            <li class="active treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>ویرایش کارت هویت</span> <i class="fa fa-angle-left pull-left"></i>
              </a>
              <ul class="treeview-menu">
                <li class=""><a href="edit-card.php"><i class="fa fa-circle-o"></i>استادان</a></li>
                <li class=""><a href="edit-card1.php"><i class="fa fa-circle-o"></i>کارمندان</a></li>
                <li class=""><a href="edit-card2.php"><i class="fa fa-circle-o"></i>کارگران</a></li>
              </ul>
            </li> -->
            <li>
              <a href="logout.php">
                <i class="fa fa-sign-out"></i> <span>خروج</span>
              </a>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
             <div class="col-md-12" style="height:15px"></div>
              <?php
                  if(isset($content))
                    echo $content;
               ?>

          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

    </div><!-- ./wrapper -->

    <script src="plugins/jQuery/jQuery-2.1.4.min.js">
      function setActiveMenuItem() {
        var currentPage = "<?php echo $currentPage; ?>";
        var menuItem = document.getElementById(currentPage);
        if (menuItem) {
          menuItem.classList.add("active");
        }
      }
      window.addEventListener("DOMContentLoaded", function() {
        setActiveMenuItem();
      });


    </script>
<!--     <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script> -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="plugins/morris/morris.min.js"></script>
    <script src="plugins/sparkline/jquery.sparkline.min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="plugins/knob/jquery.knob.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <script src="dist/js/app.min.js"></script>
    <script src="dist/js/pages/dashboard.js"></script>
    <script src="dist/js/demo.js"></script>

  </body>
</html>
 <?php }
   else{
    header("location:login.php");
}?>
<script>
  function setActiveMenuItem(){
    var currentPage = "home";

    var menuItem = document.getElementById(currentPage);
    if (menuItem){
      menuItem.classList.add("active");
    }
  }
  window.addEventListener("DOMContentLoaded",function (){setActiveMenuItem();} {

  })
</script>