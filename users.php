<?php
   ob_start();
   include ('config.php');
   session_start();
   session_write_close();
   if($_SESSION['role'] == "superadmin"){
?>
<div class="col-md-12">
    <a href="#insertmodal" data-toggle="modal" class="btn btn-sm active" style="font-weight:bold !important">اضافه نمودن کاربر جدید</a>
</div>

<!-- here data will be displayed -->
<div class="col-md-8" id="ContentDiv">

</div>
<!-- end displaying Div -->

<!-- modal for inserting teachers -->
<div class="modal" id="insertmodal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title text-center"  style="font-weight:bold;">فورم  ثبت  کاربر جدید</h4>
      </div>

      <div class="modal-body" style="padding:8px 20px !important">

          <form method="POST" enctype="multipart/form-data" class="formInsert">
            <div class="row">

              <div class="form-group col-md-12" style="margin-top:10px !important">
                <div class="row">
                  <label for="" class="col-md-3 text-left"  style="margin-left:-20px !important">اسم کاربر &nbsp;&nbsp;&nbsp;:</label>
                  <div class="col-md-8">
                    <input type="text" name="username" value="" class="form-control" placeholder="اسم کاربر را وارد کنید">
                  </div>
                </div>
              </div>
             <div class="form-group col-md-12">
               <div class="row">
                 <label for="" class="col-md-3 text-left" style="margin-left:-20px !important">پسورد &nbsp;&nbsp;&nbsp;:</label>
                 <div class="col-md-8">
                   <input type="password" name="password" value="" class="form-control" placeholder="************">
                 </div>
               </div>
             </div>
            <div class="form-group col-md-12">
              <div class="row">
                <label for="" class="col-md-3 text-left" style="margin-left:-20px !important">نقش  &nbsp;&nbsp;&nbsp;:</label>
                <div class="col-md-8">
                    <select class="form-control" name="role">
                      <option value="superadmin">Super Admin</option>
                      <option value="admin">Admin</option>
                      <option value="user" selected>User</option>
                      <option value="guest" selected>Guest</option>
                  </select>
                </div>
              </div>
            </div>
           <div class="form-group col-md-12">
             <div class="row">
               <label for="" class="col-md-3 text-left" style="margin-left:-20px !important">عکس  &nbsp;&nbsp;&nbsp;:</label>
               <div class="col-md-8">
                 <input type="file" name="photo" value="" class="form-control">
               </div>
             </div>
           </div>
         </div>
        </form>

      </div>

      <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">لغو کردن</button>
          <button type="button" class="btn btn-success btn-sm" onclick="InsertUser()">ثبت کردن</button>
      </div>

    </div>
  </div>
</div>
<!-- end of inserting teachers modal -->

<!-- modal for deleting users -->
<div class="modal" id="deleteModal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      </div>
      <div class="modal-body">
	      	<form class="formdelete">
	  			<input type="text" id="deleteInputId" name="id" hidden>
		    </form>
	        <h4 class="modal-title text-center"  style="font-weight:bold;">آیا میخواهید این کاربر را حذف کنید؟</h4>
      </div>
      <div class="modal-footer">
	        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">نخیر</button>
	        <button type="button" class="btn btn-success btn-sm" data-dismiss="modal" onclick="deleteUser()">بلی</button>
      </div>
    </div>
  </div>
</div>
<!-- end of deleting users modal -->

<script type="text/javascript">

  // this is for displaying teachers
  function ShowUsers(){
     let divcontent = document.querySelector("#ContentDiv");
     let xhr = new XMLHttpRequest();
        xhr.open("POST","php/select-users.php",true);
        xhr.onload = ()=>{
            if(xhr.readyState === XMLHttpRequest.DONE)
            {
                if(xhr.status == 200)
                {
                  let data = xhr.response;
                  divcontent.innerHTML = data;
                }
            }
        }
		    <?php if(isset($_GET['page'])){ ?>
		    	let page = <?php echo $_GET['page']; ?>;
    		    xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			    xhr.send("page="+ page);
			<?php } else { ?>
			    xhr.send();
			<?php } ?>
  }
  ShowUsers();
  // end of displaying teachers func

  // this function is for inserting new teacher
  function InsertUser(){
      const form = document.querySelector(".formInsert");
        let xhr = new XMLHttpRequest();
        xhr.open("POST","php/insert-user.php",true);
        xhr.onload = ()=>{
            if(xhr.readyState === XMLHttpRequest.DONE)
            {
                if(xhr.status == 200)
                {
                  let data = xhr.response;
                  if(data == "تمام معلومات ضروری میباشد" || data=="این کاربر در سیستم وجود دارد" || data=="خطا در سیستم" || data =="فارمت عکس ( jpg , jpeg , png ) باشد")
                  {
                    toastr.error(data,"خطا",{timeOut:2000});
                  }
                  else
                  {
                    toastr.success(data,"موفقیت",{timeOut:2000});
                    form.reset();
                    ShowUsers();
                  }
                }
            }
        }
        let formData = new FormData(form);
        xhr.send(formData);
  }
  // end of Insert teacher func

  function deleteFunc(ID){
    const i = document.querySelector("#deleteInputId");
    let id  = ID;
    i.value = id;
  }

    // this function is for inserting new teacher
    function deleteUser(){
        const form = document.querySelector(".formdelete");
          let xhr = new XMLHttpRequest();
          xhr.open("POST","php/delete-user.php",true);
          xhr.onload = ()=>{
              if(xhr.readyState === XMLHttpRequest.DONE)
              {
                  if(xhr.status == 200)
                  {
                    let data = xhr.response;
                    if(data == "خطا در سیستم")
                    {
                      toastr.error(data,"خطا",{timeOut:2000});
                    }
                    else
                    {
                      toastr.success(data,"موفقیت",{timeOut:2000});
                      ShowUsers();
                    }
                  }
              }
          }
          let formData = new FormData(form);
          xhr.send(formData);
    }
    // end of Insert teacher func

// function for searching users
let a = document.getElementById("search");
const btn = document.querySelector("#search");
btn.onkeyup = ()=>{
    let search = a.value;
    let divcontent = document.querySelector("#ContentDiv");
      let xhr = new XMLHttpRequest();
        xhr.open("POST","php/search-user.php",true);
        xhr.onload = ()=>{
            if(xhr.readyState === XMLHttpRequest.DONE)
            {
                if(xhr.status == 200)
                {
                  let data = xhr.response;
                  divcontent.innerHTML = data;
                  if(search == "")
                      ShowWorkers();
                }
            }
        }
        xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xhr.send("search="+ search);
 }

</script>

<?php ob_start(); ?>
<!--search box-->
     <form action="#" class="sidebar-form">
       <div class="input-group">
         <input type="text" name="search" id="search" class="form-control" placeholder="جستجو ...">
         <span class="input-group-btn">
           <button type="button" class="btn btn-flat"><i class="fa fa-search"></i></button>
         </span>
       </div>
     </form>
<!--end search box-->
<?php $search = ob_get_contents(); ob_get_clean(); ?>

<?php
   $content = ob_get_contents();
   ob_get_clean();
   include ('index.php');
 } else {
   header("location:teachers.php");
 }
?>
