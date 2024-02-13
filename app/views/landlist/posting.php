<?php $this->view("landlist/header", $data); ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Posting</li>
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
                      <label class="col-sm-2 col-form-label">Type</label>
                      <div class="col-sm-10">
                        <select class="form-select" aria-label="Default select example" id="type" name="type" style="margin-left: 15%; margin-right: 15%;width: 70%;">
                          <option value="0" selected>-Please choose a job type-</option>
                            <?php
                              foreach ($data['type'] as $key => $value) {
                                  echo "<option value='".$key."'>".$value."</option>";                                            
                              }
                            ?>
                        </select>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label">Category</label>
                      <div class="col-sm-10">
                        <select class="form-select" aria-label="Default select example" id="category" name="category" style="margin-left: 15%; margin-right: 15%;width: 70%;">
                          <option value="0" selected>-Please choose a job category-</option>
                          <?php
                            foreach ($data['category'] as $key => $value) {
                              echo "<option value='".$key."'>".$value."</option>";
                            }
                          ?>
                        </select>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <div class="col-sm-10">
                        <button onclick="p1()" class="btn btn-primary">Save and Continue</button>
                      </div>
                    </div>
                    <div class="row mb-3 alert-warning" id="tks"></div> 

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
  xhr.open("POST", '<?=ROOT?>posting/s1/0', true);

  //Send the proper header information along with the request
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  var type = document.getElementById("type").value;  
  var category = document.getElementById("category").value;
  var params = "type="+type+"&category="+category;
  xhr.onreadystatechange = function() { // Call a function when the state changes.
      if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
          document.getElementById("tks").innerHTML = this.responseText;
          if (this.responseText == 'successfully') {
            location.href = '<?=ROOT?>posting/s2/0';
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