   <?php
require_once '../Configurasi/koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="shortcut icon" href="../assets/images/logo_title.png" />
    <link href="../assets/css/validate.css" rel="stylesheet" >
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

<body  style="background-image: url(../assets/images/adminbnnr.jpg);background-size: cover; ">
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
        <table class="table table-borderless table-light"  style="margin-left: 35%; max-width: 30%; margin-top: 90px; ">
            <form action="simpan-pendaftaran.php" method="POST" id="registration_form" >
              <tr style="text-align: center;">
                  <th><h3 style="font-family: fantasy;">Sign Up</h3></th>
              </tr>
              <tr>
                
                 <td> <input type="text " class="form-control" placeholder="Username" id="form_username" name="username"   ><span class="error_form" id="uname_error_message"></span></td>
              </tr>
              <tr>
                 <td> <input type="text " class="form-control" placeholder="Nama Lengkap" id="form_name" name="nama" >	<span class="error_form" id="name_error_message"></span></td>
              </tr>
              <tr>
              <td >  <input type="email" class="form-control" placeholder="E-mail" id="form_email" name="email" ><span class="error_form" id="email_error_message"></span></td>
              </tr>
              <tr>
                  <td ><input type="password" class="form-control" placeholder="Password" id="form_password" name="password" ><span class="error_form" id="password_error_message"></span></td>
              </tr>
              <tr>
                  <td> <input type="password" class="form-control" placeholder="Konfirmasi Password" id="form_retype_password" name="cpass" ><span class="error_form" id="retype_password_error_message"></span></td></td>
              </tr>
              <tr style="text-align: center;">            
                <td><button type="submit" class="btn btn-dark" name="submit" id="submit">Register</button></td>
               
            </tr>
              <tr>
                  <td>Already Have An Account?&nbsp;&nbsp;<a href="login.php" style="text-decoration: none;">Log In</a></td>
                </tr>
              </form>
              <script type="text/javascript">
         $(function() {

         $("#uname_error_message").hide();
         $("#name_error_message").hide();
         $("#email_error_message").hide();
         $("#password_error_message").hide();
         $("#retype_password_error_message").hide();

         var error_uname = false;
         var error_name = false;
         var error_email = false;
         var error_password = false;
         var error_retype_password = false;

         $("#form_username").focusout(function(){
            check_uname();
         });
         $("#form_name").focusout(function() {
            check_name();
         });
         $("#form_email").focusout(function() {
            check_email();
         });
         $("#form_password").focusout(function() {
            check_password();
         });
         $("#form_retype_password").focusout(function() {
            check_retype_password();
         });

         function check_uname() {
            var fname = $("#form_username").val();
            if ( fname !== '') {
               $("#uname_error_message").hide();
               $("#form_username").css("border-bottom","2px solid #34F458");
            }else {
               $("#uname_error_message").html("Masukkan Username Anda");
               $("#uname_error_message").show();
               $("#form_username").css("border-bottom","2px solid #F90A0A");
               error_uname = true;
            }
         }

         function check_name() {
            var sname = $("#form_name").val()
            if ( sname !== '') {
               $("#name_error_message").hide();
               $("#form_name").css("border-bottom","2px solid #34F458");
            } else {
               $("#name_error_message").html("Masukkan Nama Anda");
               $("#name_error_message").show();
               $("#form_name").css("border-bottom","2px solid #F90A0A");
               error_name = true;
            }
         }

         function check_password() {
            var password_length = $("#form_password").val().length;
            if (password_length < 8) {
               $("#password_error_message").html("Minimal 8 Karakter");
               $("#password_error_message").show();
               $("#form_password").css("border-bottom","2px solid #F90A0A");
               error_password = true;
            } else {
               $("#password_error_message").hide();
               $("#form_password").css("border-bottom","2px solid #34F458");
            }
         }

         function check_retype_password() {
            var password = $("#form_password").val();
            var retype_password = $("#form_retype_password").val();
            if (password !== retype_password) {
               $("#retype_password_error_message").html("Password Tidak Sesuai");
               $("#retype_password_error_message").show();
               $("#form_retype_password").css("border-bottom","2px solid #F90A0A");
               error_retype_password = true;
            }else if(retype_password ==''){
               $("#name_error_message").html("Masukkan Nama Anda");
               $("#name_error_message").show();
               $("#form_name").css("border-bottom","2px solid #F90A0A");
               error_name = true;
            } else {
               $("#retype_password_error_message").hide();
               $("#form_retype_password").css("border-bottom","2px solid #34F458");
            }
         }

         function check_email() {
            var pattern = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            var email = $("#form_email").val();
            if (pattern.test(email) && email !== '') {
               $("#email_error_message").hide();
               $("#form_email").css("border-bottom","2px solid #34F458");
            } else {
               $("#email_error_message").html("Format Email Tidak Sesuai");
               $("#email_error_message").show();
               $("#form_email").css("border-bottom","2px solid #F90A0A");
               error_email = true;
            }
         }

         $("#registration_form").submit(function() {
            error_uname = false;
            error_name = false;
            error_email = false;
            error_password = false;
            error_retype_password = false;

            check_uname();
            check_name();
            check_email();
            check_password();
            check_retype_password();

            if (error_name === false && error_name === false && error_email === false && error_password === false && error_retype_password === false) {
               return true;
            } else {
               swal("Maaf!", "Proses Pendaftaran Gagal!", "error");
               return false;
            }
  
         });
      });
   </script>
</body>
</html>