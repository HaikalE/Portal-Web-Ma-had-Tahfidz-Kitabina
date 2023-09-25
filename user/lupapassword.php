<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="shortcut icon" href="../assets/images/logo.png" />
    <link href="assets/css/validate.css" rel="stylesheet" >
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

<table  class="table table-borderless table-light"  style="margin-left: 35%; max-width: 30%; margin-top: 90px; ">
<form action="cek_reset.php" method="POST" id="reset_form">
          <tr>
               <td ><img src="../assets/images/logo.png" alt="logom" width="100px"  style=" display: block;margin-left: auto;margin-right: auto;"></td>
          </tr>
          <tr style="text-align: center;">
              <th><h3 style="font-family: fantasy;">Reset Password</h3></th>
          </tr>
          <tr>
          <td><?php 
	if(isset($_GET['pesan'])){
		if($_GET['pesan'] == "gagal"){
          echo"<h6 style='color:red'>Ganti password gagal! username salah!</h6> ";
      }
   }
          ?>
          </td>
          </tr>
          <tr>
              <td ><input type="email" class="form-control" autocomplete="off" placeholder="Enter Email" id="form_email" name="email"><span class="error_form" id="email_error_message"></span></td></td>
          </tr>
          <tr> 
              <td > <input type="password" class="form-control" placeholder="Enter new password" id="form_password" name="password"><span class="error_form" id="password_error_message"></span></td></td>
          </tr>
    
          <tr style="text-align: center;">            
              <td><button type="submit" class="btn btn-dark" name="submit">Reset Password</button></td>          
          </tr>        
          <tr>
              <td>Back to Login Page?&nbsp;&nbsp;<a href="login.php" style="text-decoration: none;">Click Here</a></td>           
          </tr>
        </form>
        <script type="text/javascript">
         $(function() {

          $("#email_error_message").hide();
         $("#password_error_message").hide();

         var error_email = false;      
         var error_password = false;

         $("#form_email").focusout(function(){
            check_email();
         });
         $("#form_password").focusout(function() {
            check_password();
         });
   
          function check_email() {
            var pattern = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            var email = $("#form_email").val();
            if (pattern.test(email) && email !== '') {
               $("#email_error_message").hide();
               $("#form_email").css("border-bottom","2px solid #34F458");
            } else {
               $("#email_error_message").html("Format Email Salah");
               $("#email_error_message").show();
               $("#form_email").css("border-bottom","2px solid #F90A0A");
               error_email = true;
            }
         }

         function check_password() {
            var password_length = $("#form_password").val().length;
            if (password_length < 8) {
               $("#password_error_message").html("Masukkan Minimal 8 Karakter");
               $("#password_error_message").show();
               $("#form_password").css("border-bottom","2px solid #F90A0A");
               error_password = true;
            } else {
               $("#password_error_message").hide();
               $("#form_password").css("border-bottom","2px solid #34F458");
            }
         }

         $("#reset_form").submit(function() {
            error_email = false;           
            error_password = false;
        
            check_email();         
            check_password();
          
            if (error_email == false  && error_password == false ) {
              
               return true;
            } else {
               swal("Maaf!", "Ganti Password Gagal!", "error");
               return false;
            }

         });
      });
   </script>
   </table>
</body>
</html>