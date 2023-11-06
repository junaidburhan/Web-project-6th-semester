<?php
   ob_start();
   session_start();
   session_write_close();
   include ('config.php');
?>
<?php if($_SESSION['role'] != "guest"){ ?>
<div class="col-md-12">
    <a href="#insertmodal" data-toggle="modal" class="btn btn-sm active" style="font-weight:bold !important">اضافه نمودن استاد جدید</a>
</div>
<?php } ?>

<!-- here data will be displayed -->
<div class="col-md-12" id="ContentDiv">	</div>
<!-- end displaying Div -->

<!-- modal for inserting teachers -->
<div class="modal" id="insertmodal" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-center"  style="font-weight:bold;">فورم  ثبت  نام استادان</h4>
      </div>
      <div class="modal-body" style="padding:0px 20px !important">
          <form method="POST" enctype="multipart/form-data" class="formInsert">
            <div class="row">

             <div class="form-group col-md-3">
                <label for="">اسم </label>
                <input type="text" name="name" value="" class="form-control" placeholder="اسم فارسی" required>
             </div>
             <div class="form-group col-md-3">
                 <label for="">اسم انگلیسی</label>
                 <input type="text" name="ename" value="" class="form-control" placeholder="اسم انگلیسی" required>
             </div>
             <div class="form-group col-md-3">
               <label for="">تخلص </label>
               <input type="text" name="lname" value="" class="form-control" placeholder="تخلص فارسی" required>
             </div>
             <div class="form-group col-md-3">
               <label for="">تخلص انگلیسی</label>
               <input type="text" name="elname" value="" class="form-control" placeholder="تخلص انگلیسی" required>
             </div>
            <div class="form-group col-md-3">
               <label for="">اسم پدر</label>
               <input type="text" name="fname" value="" class="form-control" placeholder="اسم پدر">
            </div>
            <div class="form-group col-md-3">
                <label for="">شماره تماس</label>
                <input type="text" name="phone" class="form-control" required placeholder="شماره تماس"  maxlength="10">
            </div>
            <div class="form-group col-md-3">
                <label for="">ایمیل آدرس</label>
                <input type="email" name="email" value="" class="form-control" placeholder="ایمیل آدرس" required>
            </div>
            <div class="form-group col-md-3">
                <label for="gender">جنسیت</label>
                <select class="form-control" name="gender" style="padding-top:0px !important">
                    <option value="مرد">مرد</option>
                    <option value="زن">زن</option>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label>حالت مدنی</label>
                <select class="form-control" name="status"  style="padding-top:0px !important">
                  <option value="مجرد">مجرد</option>
                  <option value="متاهل">متاهل</option>
                </select>
            </div>
            <div class="form-group col-md-3">
              <label for="">سکونت اصلی</label>
              <select name="province" class="form-control"  style="padding-top:0px !important">
                <?php
                    $provinces = mysqli_query($conn,"select * from province");
                    foreach ($provinces as $province) {
                      ?>
                      <option value="<?php echo $province['pro_id']; ?>"><?php echo $province['pro_name']; ?></option>
              <?php } ?>
              </select>
            </div>
            <div class="form-group col-md-3">
              <label for="">تاریخ تولد</label>
              <input type="text" name="birth_date" value="" placeholder="سال / ماه / روز" class="form-control" required>
            </div>
            <div class="form-group col-md-3">
              <label for="">تاریخ استخدام</label>
              <input type="text" name="hire_date" value="" placeholder="سال / ماه / روز" class="form-control" required>
            </div>
            <div class="form-group col-md-3">
              <label for="">درجه تحصیل</label>
              <select name="degree" class="form-control"  style="padding-top:0px !important">
                <?php
                  $degrees = mysqli_query($conn,"select * from degree");
                  foreach ($degrees as $degree) {
                 ?>
                <option value="<?php echo $degree['deg_id']; ?>"><?php echo $degree['deg_name']; ?></option>
              <?php } ?>
              </select>
            </div>
            <div class="form-group col-md-3">
              <label for="">رتبه علمی</label>
              <select class="form-control" name="rotba"  style="padding-top:0px !important">
              <?php
                    $rotbas = mysqli_query($conn,"select * from rotba");
                    foreach ($rotbas as $rotba) {
               ?>
                <option value="<?php echo $rotba['rot_id']; ?>"><?php echo $rotba['rot_name']; ?></option>
              <?php } ?>
              </select>
            </div>
            <div class="form-group col-md-3">
              <label for="">نوع وظیفه</label>
              <select class="form-control" name="job"  style="padding-top:0px !important">
              <?php
                    $jobs = mysqli_query($conn,"select * from job");
                    foreach ($jobs as $job) {
               ?>
                <option value="<?php echo $job['job_id']; ?>"><?php echo $job['job_name']; ?></option>
              <?php } ?>
              </select>
            </div>
            <div class="form-group col-md-3">
              <label for="">پوهنحٔی</label>
              <select class="form-control" name="faculty"  style="padding-top:0px !important">
                <?php
                    $faculties =  mysqli_query($conn,"select * from faculty");
                    foreach ($faculties as $faculty) {
                    ?>
                    <option value="<?php echo $faculty['fac_id']; ?>"><?php echo $faculty['fac_name']; ?></option>
                  <?php } ?>
              </select>
            </div>
            <div class="form-group col-md-3">
              <label for="">موقف کاری</label>
              <input type="text" name="position" value="" class="form-control" placeholder="موقف کاری فارسی" required>
            </div>

            <div class="form-group col-md-3">
              <label for="">موقف کاری به انگلیسی</label>
              <input type="text" name="eposition" value="" class="form-control" placeholder="موقف کاری انگلیسی" required>
            </div>
            <div class="form-group col-md-3">
              <label for="">عکس</label>
              <input type="file" name="photo" value="" class="form-control" required>
            </div>
            <div class="col-md-12">
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">لغو کردن</button>
          <button type="button" class="btn btn-success btn-sm" onclick="InsertTeacher()">ثبت کردن</button>
      </div>
    </div>
  </div>
</div>
<!-- end of inserting teachers modal -->


<?php if($_SESSION['role'] != "guest"){ ?>
<!-- modal for editing teachers -->
<div class="modal" id="editModal" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-center"  style="font-weight:bold;">فورم  ویرایش استادان</h4>
      </div>
      <div class="modal-body" style="padding:0px 20px !important">
          <form method="POST" enctype="multipart/form-data" class="formEdit">
            <div class="row">

             <div class="form-group col-md-3">
                <label for="">اسم </label>
                <input type="text" name="id" value="" id="id" hidden>
                <input type="text" name="name" id="name" value="" class="form-control" placeholder="اسم فارسی" required>
             </div>
             <div class="form-group col-md-3">
                 <label for="">اسم انگلیسی</label>
                 <input type="text" name="ename" id="ename" value="" class="form-control" placeholder="اسم انگلیسی" required>
             </div>
             <div class="form-group col-md-3">
               <label for="">تخلص </label>
               <input type="text" name="lname"  id="lname" value="" class="form-control" placeholder="تخلص فارسی" required>
             </div>
             <div class="form-group col-md-3">
               <label for="">تخلص انگلیسی</label>
               <input type="text" name="elname" id="elname" value="" class="form-control" placeholder="تخلص انگلیسی" required>
             </div>
            <div class="form-group col-md-3">
               <label for="">اسم پدر</label>
               <input type="text" name="fname" id="fname" value="" class="form-control" placeholder="اسم پدر">
            </div>
            <div class="form-group col-md-3">
                <label for="">شماره تماس</label>
                <input type="text" name="phone" id="phone" class="form-control" required placeholder="شماره تماس"  maxlength="10">
            </div>
            <div class="form-group col-md-3">
                <label for="">ایمیل آدرس</label>
                <input type="email" name="email" id="email" value="" class="form-control" placeholder="ایمیل آدرس" required>
            </div>
            <div class="form-group col-md-3">
                <label for="gender">جنسیت</label>
                <select class="form-control" name="gender" id="gender" style="padding-top:0px !important">
                    <option value="مرد">مرد</option>
                    <option value="زن">زن</option>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label>حالت مدنی</label>
                <select class="form-control" name="status"  id="status" style="padding-top:0px !important">
                  <option value="مجرد">مجرد</option>
                  <option value="متاهل">متاهل</option>
                </select>
            </div>
            <div class="form-group col-md-3">
              <label for="">سکونت اصلی</label>
              <select name="province" class="form-control" id="province" style="padding-top:0px !important">
                <?php
                    $provinces = mysqli_query($conn,"select * from province");
                    foreach ($provinces as $province) {
                      ?>
                      <option value="<?php echo $province['pro_id']; ?>"><?php echo $province['pro_name']; ?></option>
              <?php } ?>
              </select>
            </div>
            <div class="form-group col-md-3">
              <label for="">تاریخ تولد</label>
              <input type="text" name="birth_date" id="birth_date" value="" placeholder="سال / ماه / روز" class="form-control" required>
            </div>
            <div class="form-group col-md-3">
              <label for="">تاریخ استخدام</label>
              <input type="text" name="hire_date" id="hire_date" value="" placeholder="سال / ماه / روز" class="form-control" required>
            </div>
            <div class="form-group col-md-3">
              <label for="">درجه تحصیل</label>
              <select name="degree" class="form-control" id="degree" style="padding-top:0px !important">
                <?php
                  $degrees = mysqli_query($conn,"select * from degree");
                  foreach ($degrees as $degree) {
                 ?>
                <option value="<?php echo $degree['deg_id']; ?>"><?php echo $degree['deg_name']; ?></option>
              <?php } ?>
              </select>
            </div>
            <div class="form-group col-md-3">
              <label for="">رتبه علمی</label>
              <select class="form-control" name="rotba" id="rotba" style="padding-top:0px !important">
              <?php
                    $rotbas = mysqli_query($conn,"select * from rotba");
                    foreach ($rotbas as $rotba) {
               ?>
                <option value="<?php echo $rotba['rot_id']; ?>"><?php echo $rotba['rot_name']; ?></option>
              <?php } ?>
              </select>
            </div>
            <div class="form-group col-md-3">
              <label for="">نوع وظیفه</label>
              <select class="form-control" name="job" id="job" style="padding-top:0px !important">
              <?php
                    $jobs = mysqli_query($conn,"select * from job");
                    foreach ($jobs as $job) {
               ?>
                <option value="<?php echo $job['job_id']; ?>"><?php echo $job['job_name']; ?></option>
              <?php } ?>
              </select>
            </div>
            <div class="form-group col-md-3">
              <label for="">پوهنحٔی</label>
              <select class="form-control" name="faculty" id="faculty" style="padding-top:0px !important">
                <?php
                    $faculties =  mysqli_query($conn,"select * from faculty");
                    foreach ($faculties as $faculty) {
                    ?>
                    <option value="<?php echo $faculty['fac_id']; ?>"><?php echo $faculty['fac_name']; ?></option>
                  <?php } ?>
              </select>
            </div>
            <div class="form-group col-md-3">
              <label for="">موقف کاری</label>
              <input type="text" name="position" id="position" value="" class="form-control" placeholder="موقف کاری فارسی" required>
            </div>

            <div class="form-group col-md-3">
              <label for="">موقف کاری به انگلیسی</label>
              <input type="text" name="eposition" id="eposition" value="" class="form-control" placeholder="موقف کاری انگلیسی" required>
            </div>
            <div class="form-group col-md-3">
              <label for="">عکس</label>
              <input type="file" name="photo" id="photo" value="" class="form-control" style="display:none"><br>
              <img src="" id="inputImg" width="40" height="40">
		      			<span id="span" style="cursor: pointer;text-decoration: underline;color: #0055ff;margin-left:10px" onclick="HidePhoto()">change photo</span>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" onclick="showAgain()">لغو کردن</button>
          <button type="button" class="btn btn-success btn-sm" onclick="editTeacher()" data-dismiss="modal">ویرایش کردن</button>
      </div>
    </div>
  </div>
</div>
<!-- end of editing teachers modal -->
<?php } ?>

<!-- modal for displaying employees detail -->
<div class="modal" id="detailsModal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      		<h4  class="text-center"><b>جزیٔیات  بیشتر</b></h4>
      </div>
      <div class="modal-body" id="detailsDiv">

      </div>
      <div class="modal-footer">
      		<button class="btn btn-danger btn-sm" data-dismiss="modal">بستن</button>
      </div>
    </div>
  </div>
</div>
<!-- end of details modal -->

<?php if($_SESSION['role'] == "superadmin"){ ?>
<!-- modal for editing cards -->
<div class="modal" id="editCardModal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      </div>
      <div class="modal-body">
          <h4  class="text-center"><b> آیا میخواهید چاپ کارت هویت از سر گرفته شود؟ </b></h4>
          <form  method="POST" class="EditCardForm">
            <input type="text" hidden="hidden" name="id" id="cardID">
          </form>
      </div>
      <div class="modal-footer">
          <button class="btn btn-danger btn-sm" data-dismiss="modal">نخیر</button>
          <button class="btn btn-success btn-sm" data-dismiss="modal" onclick="editCard1()">بلی</button>
      </div>
    </div>
  </div>
</div>
<?php } ?>

<script type="text/javascript">
  // this is for displaying teachers
  function ShowTeachers(){
     let divcontent = document.querySelector("#ContentDiv");
     let xhr = new XMLHttpRequest();
        xhr.open("POST","php/select-teachers.php",true);
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
    ShowTeachers();
  // end of displaying teachers func


  // this function is for inserting new teacher
  function InsertTeacher(){
      const form = document.querySelector(".formInsert");
        let xhr = new XMLHttpRequest();
        xhr.open("POST","php/insert-teacher.php",true);
        xhr.onload = ()=>{
            if(xhr.readyState === XMLHttpRequest.DONE)
            {
                if(xhr.status == 200)
                {
                  let data = xhr.response;
                  if(data == "تمام معلومات ضروری میباشد" || data=="خطا در سیستم"  || data == "این ایمیل آدرس در سیستم وجود دارد" || data =="فارمت عکس   ( jpg , png , jpeg ) باشد" || data=="ایمیل آدرس شما درست نمیباشد")
                  {
                    toastr.error(data,"خطا",{timeOut:2000});
                  }
                  else
                  {
                    toastr.success(data,"موفقیت",{timeOut:2000});
                    form.reset();
                    ShowTeachers();
                  }
                }
            }
        }
        let formData = new FormData(form);
        xhr.send(formData);
  }
  // end of Insert teacher func

  function SetValues(ID,NAME,LNAME,FNAME,ENAME,ELNAME,GENDER,EMAIL,PHONE,STATUS,BIRTH,HIRE,PRO,ROTBA,POS,EPOS,FAC,JOB,DEG,PHOTO){
    let id = ID;   let name = NAME;  let lname = LNAME;
    let fname = FNAME;    let ename = ENAME;  let elname = ELNAME;
    let gender = GENDER;  let email = EMAIL; let phone = PHONE;
    let status = STATUS;  let birth = BIRTH;    let hire = HIRE;
    let province = PRO;    let rotba = ROTBA;   let position = POS;
    let eposition = EPOS;  let faculty = FAC;  let job = JOB;  let degree = DEG;
    let photo = PHOTO;
    const id1 = document.querySelector("#id");    const name1 = document.querySelector("#name");
    const lname1 = document.querySelector("#lname");    const fname1 = document.querySelector("#fname");
    const ename1 = document.querySelector("#ename");    const elname1 = document.querySelector("#elname");
    const gender1 = document.querySelector("#gender");    const email1 = document.querySelector("#email");
    const phone1 = document.querySelector("#phone");  const status1 = document.querySelector("#status");
    const birth_date1 = document.querySelector("#birth_date");    const hire_date1 = document.querySelector("#hire_date");
    const province1 = document.querySelector("#province");    const rotba1 = document.querySelector("#rotba");
    const position1 = document.querySelector("#position");    const eposition1 = document.querySelector("#eposition");
    const faculty1 = document.querySelector("#faculty");    const job1 = document.querySelector("#job");
    const degree1 = document.querySelector("#degree");    const photo1 = document.querySelector("#photo");
    const img = document.querySelector("#inputImg");
    id1.value = id;    name1.value =name;   lname1.value = lname;
    fname1.value = fname;    ename1.value = ename;    elname1.value = elname;
    gender1.value = gender;  email1.value = email;    phone1.value = phone;
    status1.value = status;    birth_date1.value = birth;    hire_date1.value = hire;
    province1.value = province;     rotba1.value = rotba;    position1.value = position;
    eposition1.value = eposition;    faculty1.value = faculty;
    job1.value = job;    degree1.value = degree;    img.src = photo;
  }

  function editTeacher(){
    const form = document.querySelector(".formEdit");
      let xhr = new XMLHttpRequest();
        xhr.open("POST","php/edit-teacher.php",true);
        xhr.onload = ()=>{
            if(xhr.readyState === XMLHttpRequest.DONE)
            {
                if(xhr.status == 200)
                {
                  let data = xhr.response;
                  if(data == "این ایمیل آدرس در سیستم وجود دارد" || data=="خطا در سیستم" || data=="فارمت عکس ( jpg , jpeg , png )  باشد")
                  {
                    toastr.error(data,"خطا",{timeOut:2500});
                  }
                  else
                  {
                    toastr.success(data,"موفقیت",{timeOut:2500});
                    ShowTeachers();
                  }
                }
            }
        }
        let formData = new FormData(form);
        xhr.send(formData);
        showPhoto();
   }// end of editSubject func

// this two is function for displaying change photo option
  function HidePhoto(){
      const f = document.querySelector("#photo");
      const i = document.querySelector("#inputImg");
      const s = document.querySelector("#span");
      f.style.display = "inline";
      i.style.display = "none";
      s.style.display = "none";
   }
  function showPhoto(){
      const f = document.querySelector("#photo");
      const i = document.querySelector("#inputImg");
      const s = document.querySelector("#span");
      f.style.display = "none";
      i.style.display = "inline";
      s.style.display = "inline";
   }
// end of hide and show function
  function showAgain(){
    showPhoto();
  }

   // function for displaying more info about employees
   function MoreInfo(ID){
      let id = ID;
      const d = document.querySelector("#detailsDiv");
        let xhr = new XMLHttpRequest();
          xhr.open("POST","php/details-teacher.php",true);
          xhr.onload = ()=>{
              if(xhr.readyState === XMLHttpRequest.DONE)
              {
                  if(xhr.status == 200)
                  {
                    let data = xhr.response;
                    d.innerHTML = data;
                  }
              }
          }
          xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
          xhr.send("id="+ id);
   } // end of displaying func

// for setting card values
function editCard(ID)
{
  let id = ID;
  const i = document.querySelector("#cardID");
  i.value = id;
}

// for editing cards
function editCard1()
{
  const form = document.querySelector(".EditCardForm");
      let xhr = new XMLHttpRequest();
        xhr.open("POST","php/edit-card.php",true);
        xhr.onload = ()=>{
            if(xhr.readyState === XMLHttpRequest.DONE)
            {
                if(xhr.status == 200)
                {
                  let data = xhr.response;
                  if(data == 'خطا در سیستم')
                  {
                    toastr.error(data,"خطا",{timeOut:2500});
                  }
                  else
                  {
                    toastr.success(data,"موفقیت",{timeOut:2500});
                  }
                }
            }
        }
        let formData = new FormData(form);
        xhr.send(formData);
}


// function for searching teachers
let a = document.getElementById("search");
const btn = document.querySelector("#search");
btn.onkeyup = ()=>{
    let search = a.value;
    let divcontent = document.querySelector("#ContentDiv");
      let xhr = new XMLHttpRequest();
        xhr.open("POST","php/search-teacher.php",true);
        xhr.onload = ()=>{
            if(xhr.readyState === XMLHttpRequest.DONE)
            {
                if(xhr.status == 200)
                {
                  let data = xhr.response;
                  divcontent.innerHTML = data;
                  if(search == "")
                      ShowTeachers();
                }
            }
        }
        xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xhr.send("search="+ search);
 }

</script>

<!-- this is for error message -->
<?php
  if(isset($_GET['access'])){
    if(($_GET['access']=="error")){
 ?>
    <script type="text/javascript">
          toastr.error("شما بیشر از ۵ بار نمیتوانید چاپ کنید","خطا",{timeOut:2000});
    </script>
<?php
  }
}
?>
<!-- end of message -->


<?php
   $content = ob_get_contents();
   ob_get_clean();
   include ('index.php');
?>
