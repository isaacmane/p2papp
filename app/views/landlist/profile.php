<?php $this->view("landlist/header", $data); ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Recent Sales -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                  <h5 class="card-title"><?=$data['page_title']?></h5>

                  <?php
                    //show($data);
                  ?>
                    
                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label">Full Name</label>
                        <div class="col-sm-5">
                          <input type="text" class="form-control" id="username" name="username" value="<?=$data['user']['user_name']?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-5">
                          <input type="text" class="form-control" id="email" name="email" value="<?=$data['user']['email']?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label">Phone</label>
                        <div class="col-sm-5">
                          <input type="text" class="form-control" id="phone" name="phone" value="<?=$data['user']['phone']?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                      <div class="col-sm-10">
                        <button onclick="p1()" class="btn btn-primary">Save</button>
                      </div>
                    </div>
                    <div class="row alert-warning" id="tks"></div>
                    <div class="row alert-warning" id="vresp"></div>
                  </div>

              </div>
            </div><!-- End Recent Sales -->

      </div>
    </section>

  </main><!-- End #main -->

<?php $this->view("landlist/footer", $data); ?>
<script>
function p1() {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", '<?=ROOT?>profile/s1', true);

  //Send the proper header information along with the request
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  var user = document.getElementById("username").value;  
  var email = document.getElementById("email").value;
  var phone = document.getElementById("phone").value;
  var params = "u="+user+"&e="+email+"&ph="+phone;
  console.log(params);
  xhr.onreadystatechange = function() { // Call a function when the state changes.
      if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
          document.getElementById("tks").innerHTML = this.responseText;
          if (this.responseText == 'successfully') {
            //location.href = '<?=ROOT?>profile/s1';
          }
          //var pid =  this.responseText;
          //console.log(typeof(pid));
          //if (typeof pid != "string") {

            //location.href = '<?=ROOT?>posting/s2/'+pid;
            //console.log(pid);
          //}
      }
  }
  xhr.send(params);
}

function vcod() {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", '<?=ROOT?>profile/s2', true);

  //Send the proper header information along with the request
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  var code = document.getElementById("validatecd").value;  
  var user = document.getElementById("username").value;  
  var email = document.getElementById("email").value;
  var phone = document.getElementById("phone").value;
  var params = "u="+user+"&e="+email+"&ph="+phone+"&c="+code;
  console.log(params);
  xhr.onreadystatechange = function() { // Call a function when the state changes.
      if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
          document.getElementById("vresp").innerHTML = this.responseText;
          if (this.responseText == 'successfully') {
            //location.href = '<?=ROOT?>profile/s1';
          }
          //var pid =  this.responseText;
          //console.log(typeof(pid));
          //if (typeof pid != "string") {

            //location.href = '<?=ROOT?>posting/s2/'+pid;
            //console.log(pid);
          //}
      }
  }
  xhr.send(params);
}
</script>