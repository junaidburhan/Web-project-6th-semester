<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login Page</title>
    <link rel="stylesheet" href="dist/css/login.css">
  </head>
<body  style="direction: rtl;">

    <section>
      <div class="form-container">
        <h1>به سیستم وارد شوید</h1>
        <p id="error" style="color:#e60000;margin-left:20px;text-align:center"></p>
        <img src="dist/img/loader.gif" style="margin-right: 140px;width: 20px">
        <form name="loginForm" method="post" class="loginForm">
          <div class="control">
              <label for="username">نام کاربر:</label>
              <input type="text " id="username" name="username" placeholder="نام کاربر را وارد کنید" required>
          </div>
          <div class="control">
              <label for="psw">پسورد کاربر:</label>
              <input type="password" id="password" name="password" placeholder="**********" required="">
          </div>
          <div class="control">
              <input type="button" name="submit" value="وارد شدن" onclick="CheckUser()" id="login">

          </div>
        </form>

      </div>
    </section>

  <script type="text/javascript">
          const img = document.querySelector('img');
          img.style.display = 'none';

      function CheckUser(){
          const form = document.querySelector(".loginForm");
          let user = document.getElementById("username");
          let pass = document.getElementById("password");
          img.style.display = 'inline';
          document.getElementById('error').innerHTML = '';

          if(user.value != "" && pass.value != ""){
            let xhr = new XMLHttpRequest();
            xhr.open("POST","php/check-user.php",true);
            xhr.onload = ()=>{
                if(xhr.readyState === XMLHttpRequest.DONE)
                {
                    if(xhr.status == 200)
                    {
                      let data = xhr.response;
                      if(data == "نام یا پسورد شما اشتباه است" || data =="نام و پسورد ضروری میباشد")
                      {
                        img.style.display = 'none';
                        document.getElementById('error').innerHTML = data;
                        form.reset();
                      }
                      else
                      {
                         window.location.assign("teachers.php");
                      }
                    }
                }
            }
            let formData = new FormData(form);
            xhr.send(formData);
          }
          else
          {
              img.style.display = 'none';
              document.getElementById('error').innerHTML = "نام و پسورد ضروری میباشد";
              form.reset();
          }
      } // end of InsertSubject func

  </script>

 </body>
</html>
