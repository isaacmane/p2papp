<?php //$this->view("landlist/header", $data); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>JList App</title>
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
                  <span class="d-none d-lg-block">JList</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">
                  <!-- <form class="row g-3 needs-validation" novalidate>-->

                    <div class="col-12" style="margin-bottom: 0.75em;">
                      <label for="yourPassword" class="form-label">Password</label>
                      <div class="input-group has-validation" style="margin-bottom: 0.75em;">                        
                        <input type="password" name="password" class="form-control" id="password" required>
                        <div class="invalid-feedback">Please enter your username.</div>
                      </div>

                      <div class="col-12">
                        <label for="yourPassword" class="form-label">Re-type Password</label>
                        <input type="password" name="passwordrt" class="form-control" id="passwordrt" required>
                        <div class="invalid-feedback">Re-type password!</div>
                      </div>
                      <input type="hidden" class="d-none" name="email" id="email" value="<?=$_GET['e']?>">
                      <input type="hidden" class="d-none" name="valid" id="valid" value="<?=$_GET['v']?>">


                    </div>

                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit" onclick="savnPwd()" style=" margin-bottom: 1em;">Save New Password</button>
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

<script>

function savnPwd() {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", '<?=ROOT?>process', true);
  //console.log('<?=ROOT?>');
  //Send the proper header information along with the request
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  var password = document.getElementById("password").value;
  var passwordrt = document.getElementById("passwordrt").value;
  var email = document.getElementById("email").value;
  var valid = document.getElementById("valid").value;
  var paraml = "e="+email+"&p="+password+"&pr="+passwordrt+"&v="+valid+"&s=1";

  xhr.onreadystatechange = function() { // Call a function when the state changes.
      if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
          var element = document.getElementById("tks");
          element.classList.add("show"); //Fade background on response message
          document.getElementById("tks").innerHTML = this.responseText;
          if (this.responseText === 'successfully') {
            var delay = 2000;
            setTimeout(function(){
              window.location = "<?=ROOT?>login";
            },delay);
 
            //window.location.href = '<?=ROOT?>login';
          }         
      }
  }
  xhr.send(paraml);
}
</script>
<?php //$this->view("landlist/footer", $data); ?>
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