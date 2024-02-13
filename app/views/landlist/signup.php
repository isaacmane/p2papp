<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Pages / Register - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?=ASSETS?>img/favicon.png" rel="icon">
  <link href="<?=ASSETS?>img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?=ASSETS?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?=ASSETS?>vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?=ASSETS?>vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?=ASSETS?>vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="<?=ASSETS?>vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="<?=ASSETS?>vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?=ASSETS?>vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?=ASSETS?>css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.4.1
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="<?=ASSETS?>img/logo.png" alt="">
                  <span class="d-none d-lg-block">Jlist</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                    <p class="text-center small">Enter your personal details to create account</p>
                  </div>

                  <!-- <form class="row g-3 needs-validation" novalidate> -->
                    <div class="col-12">
                      <label for="yourName" class="form-label">Your Name</label>
                      <input type="text" name="username" class="form-control" id="username" required>
                      <div class="invalid-feedback">Please, enter your name!</div>
                    </div>

                    <div class="col-12">
                      <label for="yourEmail" class="form-label">Your Email</label>
                      <input type="email" name="email" class="form-control" id="email" required>
                      <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                    </div>

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Confirm Email</label>
                      <div class="input-group has-validation">
                        <!-- <span class="input-group-text" id="inputGroupPrepend">@</span>-->
                        <input type="text" name="email2" class="form-control" id="email2" required>
                        <div class="invalid-feedback">Please type same email as above.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Phone</label>
                      <div class="input-group has-validation">
                        <!-- <span class="input-group-text" id="inputGroupPrepend">@</span>-->
                        <input type="text" name="phone" class="form-control" id="phone" required>
                        <div class="invalid-feedback">Please enter your phone number.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="password" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" name="terms" type="checkbox" value="1" id="acceptTerms" required>
                        <label class="form-check-label" for="acceptTerms">I agree and accept the <a href="#">terms and conditions</a></label>
                        <div class="invalid-feedback">You must agree before submitting.</div>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit" onclick="signUp()">Create Account</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Already have an account? <a href="<?=ROOT?>login">Log in</a></p>
                    </div>
                    <div class="col-12">
                      <div class="alert alert-warning alert-dismissible fade text-center" role="alert" id="tks"></div>
                    </div>
                  <!-- </form>-->

                </div>
              </div>

              <div class="credits">
                Developed by <a href="https://datadealhub.com/">DataDealHub</a>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="<?=ASSETS?>vendor/apexcharts/apexcharts.min.js"></script>
  <script src="<?=ASSETS?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?=ASSETS?>vendor/chart.js/chart.min.js"></script>
  <script src="<?=ASSETS?>vendor/echarts/echarts.min.js"></script>
  <script src="<?=ASSETS?>vendor/quill/quill.min.js"></script>
  <script src="<?=ASSETS?>vendor/simple-datatables/simple-datatables.js"></script>
  <script src="<?=ASSETS?>vendor/tinymce/tinymce.min.js"></script>
  <script src="<?=ASSETS?>vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="<?=ASSETS?>js/main.js"></script>

</body>

</html>

<?php check_message() ?>

<script>
function signUp() {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", '<?=ROOT?>process', true);

  //Send the proper header information along with the request
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  var username = document.getElementById("username").value;  
  var email = document.getElementById("email").value;
  var email2 = document.getElementById("email2").value;
  var password = document.getElementById("password").value;
  var phone = document.getElementById("phone").value;

  var terms = 0;
  if (document.querySelector('#acceptTerms:checked')) {
     terms = 1;
  }

  var params = "u="+username+"&e="+email+"&ph="+phone+"&pw="+password+"&e2="+email2+"&t="+terms;
  xhr.onreadystatechange = function() { // Call a function when the state changes.
      if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
          var element = document.getElementById("tks");
          element.classList.add("show");
          document.getElementById("tks").innerHTML = this.responseText;
          if (this.responseText === 'successfully registered') {
            var delay = 2000;
            setTimeout(function(){
              window.location = "<?=ROOT?>login";
            },delay);
 
            //window.location.href = '<?=ROOT?>login';
          }
      }
  }
  xhr.send(params);
}
</script>