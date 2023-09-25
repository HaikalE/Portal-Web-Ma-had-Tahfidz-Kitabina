<?php

if(!isset($_SESSION)){
   session_start();
   include '../Configurasi/koneksi.php';
   if(isset($_POST['submit'])){
   // menangkap data yang dikirim dari form
   $username = $_POST['username'];
   $password = md5($_POST['password']);
   
   // menyeleksi data admin dengan username dan password yang sesuai
   $login = mysqli_query($koneksi,"select * from user where username='$username' and password='$password'");
   $data = $login->fetch_assoc();

   // menghitung jumlah data yang ditemukan
   $cek = mysqli_num_rows($login);
   if($cek > 0){
      $_SESSION['username'] = $username;
      $_SESSION['status'] = "login";
      $_SESSION['id_user'] = $data['id_user'];
      $_SESSION['nama'] = $data['nama'];
      $_SESSION['email'] = $data['email'];
      $_SESSION['level'] = $data['level'];
      if($data['level']=="admin"){
         header("location:admin.php");
      }else{
      header("location:user.php");
      }  
   }
   else{
      header("location: login.php?pesan=gagal");
      }

   }
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
    <link rel="shortcut icon" href="../assets/images/logo.png" />
   <link href="../assets/css/validate.css" rel="stylesheet" >
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script type="text/javascript" src="assets/js/jquery.js"></script>
    <script type="text/javasript" src="assets/js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script
  src="https://code.jquery.com/jquery-3.5.1.js"
  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
  crossorigin="anonymous"></script>
</head>
<body style="background-image: url(../assets/images/adminbnnr.jpg);background-size: cover; ">
<button type="button" class="btn btn-danger" style="margin-top: 10px; margin-left: 20px;">
      <a href="../index.php" style="text-decoration: none; color: white;">
      <script src="https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js"></script>
         <lord-icon
            src="https://cdn.lordicon.com/gmzxduhd.json"
            trigger="loop"
            colors="primary:#ffffff,secondary:#e8e230"
            style="width:35px;height:35px">
         </lord-icon>
         <h6>Home</h6>
      </a>
   </button>
   <br/>
	<br/>
	<br/>
      <table class="table table-borderless table-light" style="margin-left: 35%; max-width: 30% ; margin-top: 00px;">
        <form action="" method="POST" id="login_form">
          <tr>
               <td ><img src="../assets/images/logo.png" alt="logo" width="150px" style=" display: block;margin-left: auto;margin-right: auto;"></td>
          </tr>
          <tr style="text-align: center;">
              <th><h3 style="font-family:fantasy;">Log In</h3></th>
          </tr>
          <tr>
          <td><?php 
               if(isset($_GET['pesan'])){
                  if($_GET['pesan'] == "gagal"){
                     echo"<h6 style='color:red'>Login Failed! Please Check Your Username or Password!</h6>";
                  }else if($_GET['pesan'] == "logout"){
                     echo "<i>Logout Successful!</i>";
                  }else if($_GET['pesan'] == "belum_login"){
                     echo "Make Sure You Login as Admin";
                  }else if($_GET['pesan'] == "sukses"){
                        echo"Data Stored!";
                  }
               }
               ?></td>
          </tr>
          <tr>
              <td ><input type="text" class="form-control" placeholder="Username" id="form_username" name="username"><span class="error_form" id="uname_error_message"></span></td></td>
          </tr>
          <tr>
              <td > <input type="password" class="form-control" placeholder="Password" id="form_password" name="password"><span class="error_form" id="password_error_message"></span></td></td>
          </tr>
          <tr style="text-align:center;">            
              <td><button type="submit" class="btn btn-dark" name="submit">Log In</button></td>          
          </tr>
          <tr>
              <td>
               Forgot Password? <a href="lupapassword.php" style="text-decoration: none;">Click here</a><br>
               Dont Have Account?&nbsp;&nbsp;<a href="register.php" style="text-decoration: none;">Create an Account</a>
               </td>           
          </tr>
        </form>
      </table>
      <script type="text/javascript">
         $(function() {

         $("#uname_error_message").hide();
         $("#password_error_message").hide();

         var error_uname = false;      
         var error_password = false;

         $("#form_username").focusout(function(){
            check_uname();
         });
         $("#form_password").focusout(function() {
            check_password();
         });

         function check_uname() {
          
            var fname = $("#form_username").val();
            if ( fname !== '') {
               $("#uname_error_message").hide();
               $("#form_username").css("border-bottom","2px solid #34F458");
            } else {
               $("#uname_error_message").html("Please Insert the Username");
               $("#uname_error_message").show();
               $("#form_username").css("border-bottom","2px solid #F90A0A");
               error_uname = true;
            }
         }

         function check_password() {
            var password_length = $("#form_password").val().length;
            if (password_length < 8) {
               $("#password_error_message").html("Please Insert the Password");
               $("#password_error_message").show();
               $("#form_password").css("border-bottom","2px solid #F90A0A");
               error_password = true;
            } else {
               $("#password_error_message").hide();
               $("#form_password").css("border-bottom","2px solid #34F458");
            }
         }

         $("#login_form").submit(function() {
            error_uname = false;
           
            error_password = false;

            check_uname();
          
            check_password();
          
            if (error_uname == false  && error_password == false ) {
               
               return true;
            } else {
               swal("Login Failed!", "error");
               return false;
            }
         });
      });
   </script>
</body>
</html>