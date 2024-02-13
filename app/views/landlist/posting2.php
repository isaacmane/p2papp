<?php $this->view("landlist/header", $data); ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
  <script src="https://cdn.tiny.cloud/1/l32z43zh3bj24ccg9w9occ7xd2aw1s22mg7z9k22tfgvahy7/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
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

    <section class="section">
      <div class="row">
        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title"><?=$data['page_title']?></h5>
              <?php 
              //show($data);
              /*[0] => stdClass Object
                (
                    [id] => 13
                    [user_id] => 28
                    [title] => 
                    [type] => 1
                    [category] => 1
                    [datepost] => 2022-11-22 11:07:41
                    [description] => 
                    [company] => 
                    [position] => 
                    [vacancies_id] => 
                    [experience_id] => 
                    [clevel_id] => 
                    [elevel_id] => 
                    [state_id] => 
                    [city_id] => 
                    [status] => 1
                )*/
              ?>
              <!-- General Form Elements -->
              <div class="row mb-3">
                <label for="inputText" class="col-sm-3 col-form-label">Type</label>
                <div class="col-sm-9">
                  <?php
                    if(isset($data['postdata'][0]->type)) { 
                      echo $data['type'];
                      //echo "<input type='text' class='form-control' id='company' name='company' value='".$data['postdata'][0]->type."'>";                      
                    }else{
                      echo "<input type='text' class='form-control' id='type' name='type' value=''>";  
                    }
                  ?>
                </div>
              </div>

              <div class="row mb-3">
                <label for="inputText" class="col-sm-3 col-form-label">Category</label>
                <div class="col-sm-9">
                  <?php echo $data['category']; ?>
                </div>
              </div>

              <div class="row mb-3">
                <label for="inputText" class="col-sm-3 col-form-label">Company</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="company" name="company" value="<?=$data['postdata'][0]->company?>">
                </div>
              </div>

              <div class="row mb-3">
                <label for="inputText" class="col-sm-3 col-form-label">Position</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="position" name="position" value="<?=$data['postdata'][0]->position?>">
                </div>
              </div>

              <div class="row mb-3">
                <label for="inputText" class="col-sm-3 col-form-label">Vacancies</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="vacancies" name="vacancies" value="<?=$data['postdata'][0]->vacancies_id?>">
                </div>
              </div>       

              <div class="row mb-3">
                <label for="inputText" class="col-sm-3 col-form-label">Experience</label>
                <div class="col-sm-9">
                  <?php echo $data['experience']; ?>
                </div>
              </div>

              <div class="row mb-3">
                <label for="inputText" class="col-sm-3 col-form-label">Education Levels</label>
                <div class="col-sm-9">
                  <?php echo $data['elevel']; ?>
                </div>
              </div>

              <div class="row mb-3">
                <label for="inputText" class="col-sm-3 col-form-label">Career Levels</label>
                <div class="col-sm-9">
                  <?php echo $data['clevel']; ?>
                </div>
              </div>         

              <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Work Location</label>
                <div class="col-sm-9">
                  <?php echo $data['work_location']; ?>
                </div>
              </div>

              <div class="row mb-3">
                <label class="col-sm-3 col-form-label">State</label>
                <div class="col-sm-9">
                  <?php echo $data['state']; ?>
                </div>
              </div>

              <div id="cities" style="width: 100%;"></div>              

              <div class="row mb-3" style="text-align: end;">
                <!-- <div class="col-sm-12">
                  <button onclick="p2()" class="btn btn-primary">Save and Continue</button>
                </div> -->
              </div>
              <div class="row mb-3 alert-warning" id="tks"></div>     

              <!--<div class="row mb-3">
                <label class="col-sm-3 col-form-label">Remote</label>
                <div class="col-sm-9">
                  <?php echo $data['state']; ?>
                </div>
              </div>-->
            </div>
          </div>

        </div>

        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <div class="row mb-3">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Description</h5>
                      <?php echo $data['description']?>
                      <h5 class="card-title">Estimated</h5>
                      <div class="input-group mb-3">
                        <input type="text" class="form-control lestim" id="lestim" placeholder="Min" aria-label="Username" value="<?=$data['postdata'][0]->low?>">
                        <span class="input-group-text">-</span>
                        <input type="text" class="form-control hestim" id="hestim" placeholder="Max" aria-label="Server" value="<?=$data['postdata'][0]->high?>">
                      </div> 
                      <div class="row mb-3">
                        <label for="inputText" class="col-sm-3 col-form-label">Type</label>
                        <div class="col-sm-9">
                          <?php echo $data['pmntype']; ?>
                        </div>
                      </div>               
                  </div>               
                </div>
                <button onclick="p2()" class="btn btn-primary">Save and Continue</button>
              </div>

            </div>
          </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->

<?php $this->view("landlist/footer", $data); ?>

<script>
/*function forceDecimalInput(inputElement) {
  inputElement.addEventListener('keyup', function(event) {
    const inputValue = event.target.value;
    const decimalValue = parseFloat(inputValue.replace(/[^\d.]/g, ''));

    if (!isNaN(decimalValue)) {
      event.target.value = decimalValue.toFixed(2);
    } else {
      event.target.value = '';
    }
  });
}

const inputLestim = document.getElementById('lestim');
forceDecimalInput(inputLestim);
const inputHestim = document.getElementById('hestim');
forceDecimalInput(inputHestim);

function checkFloat(input) {
  const floatValue = parseFloat(input);
  return !isNaN(floatValue) && Number.isFinite(floatValue);
}*/

$('input.lestim').on('input', function() {
  this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');
});

function p2() {
  
  //xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  //xhr.setRequestHeader("Content-Type", "application/json; charset=utf-8");
  var x = 0;

  const vars = ["type","category","company", "position", "vacancies", "experience", "elevel", "clevel", "state", "lestim", "hestim","pmntype", "work_location"]; 
  var jobj = [];
  var t = "";
  for (let i = 0; i < vars.length; i++) { 
    var content = document.getElementById(vars[i]).value;
    if(!content) { 
      document.getElementById(vars[i]).className = "form-control is-invalid"; 
      x = x + 1;      
    }else{ 
      document.getElementById(vars[i]).className = "form-control";
      jobj[vars[i]] = content;
      
      //t += vars[i]+"="+content+"&";
    }    
  }
  //var dcontent = tinymce.get('description').getContent({format: 'text'});  
  var myContent = tinymce.get("description").getContent();
  var dcontent = myContent;
  //var dcontent = document.getElementById("description").value;

  if (x > 0) {
    document.getElementById("tks").innerHTML = "<div class='alert alert-danger' role='alert'>Please check required fields</div>"; 
  }else{
    var city = document.getElementById('city').value;
    if (!city) {
      document.getElementById("tks").innerHTML = "<div class='alert alert-danger' role='alert'>Please choose a city</div>";
      document.getElementById("city").className = "form-control is-invalid"; 
    }else{
      document.getElementById("city").className = "form-control";
      if(!dcontent.trim()){    
        document.getElementById("tks").innerHTML = "<div class='alert alert-danger' role='alert'>Please check description field</div>"; 
        document.getElementById("description").className = "form-control is-invalid";   
      }else{
        document.getElementById("description").className = "form-control";
        var lestim = document.getElementById("lestim").value;
        var hestim = document.getElementById("hestim").value;
        var pmntype = document.getElementById("pmntype").value;
        console.log(lestim + ' / ' + hestim + ' / '+pmntype);
        if (lestim > hestim) {
          document.getElementById("tks").innerHTML = "<div class='alert alert-danger' role='alert'>Max Estimated Payment should be higher than Min Estimated Payment</div>";
          x = 1;
        }else{
          x = 0;
        }

        if (x == 0) {
          jobj['description'] = dcontent.replace("&","");
          jobj['city'] = city;
          jobj['lestim'] = lestim;
          jobj['hestim'] = hestim;
          jobj['pmntype'] = pmntype;
          //console.log(jobj);
          //console.log('testing');

          //description, category, clevel, company, elevel, experience, f2, position, state, type, vacancies, lenght 
          
          var data = "type="+jobj['type']+"&category="+jobj['category']+"&clevel="+jobj['clevel']+"&company="+jobj['company']+"&elevel="+jobj['elevel']+"&experience="+jobj['experience']+"&proc=f2"+"&position="+jobj['position']+"&state="+jobj['state']+"&city="+jobj['city']+"&vacancies="+jobj['vacancies']+"&description="+jobj['description']+"&lestim="+jobj['lestim']+"&hestim="+jobj['hestim']+"&pmntype="+jobj['pmntype']+"&work_location="+jobj['work_location'];
          //console.log(data);

          var xhr = new XMLHttpRequest();
          xhr.open("POST", '<?=ROOT?>/posting/s1', true);
          xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
          xhr.onreadystatechange = function() { // Call a function when the state changes.
              if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                  document.getElementById("tks").innerHTML = this.responseText;
                  if (this.responseText == 'successfully') {
                    location.href = '<?=ROOT?>dashboard';
                  }
              }else{
                console.log(this.status);
              }
          }
          //console.log('here');
          //xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");    
              
          xhr.send(data);
        }        
      }      
    }    
  }
}

function chgSt() {
  
  var xhr = new XMLHttpRequest();
  xhr.open("POST", '<?=ROOT?>process/cities', true);

  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  var state = document.getElementById("state").value;
  xhr.onreadystatechange = function() { // Call a function when the state changes.
      if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
          document.getElementById("cities").innerHTML = this.responseText;  
          if (this.responseText == 'successfully') {
            location.href = '<?=ROOT?>dashboard';            
          }                 
      }
  }
  xhr.send(state);
}

function resetDD(){
  document.getElementById('state').value = 0;
  var el1 = document.getElementById("citytxt");
  el1.parentNode.removeChild(el1);
  var el2 = document.getElementById("resetbutton");
  el2.parentNode.removeChild(el2);  
  var el3 = document.getElementById("city");
  el3.parentNode.removeChild(el3);
  var dropdownst = document.getElementById("state");
  dropdownst.disabled = false;
}

tinymce.init({
    selector: 'textarea',
    plugins: 'autolink charmap lists searchreplace visualblocks',
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
  });
</script>