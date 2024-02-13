<?php $this->view("landlist/header", $data); ?>
 <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-container">
                        <h2><?=$data['page_title']?></h1>
                        <p class="p-large p-heading">Dashboard</p>     
                        <div class="row">
                            <div class="col">
                                <div class="jumbotron jumbotron-fluid">
                                  <div class="container">
                                    <h3>Choose the Location</h1>
                                    <p class="lead">
                                      <form>
                                        <div class="form-group">
                                          <select class="form-control" id="state" style="margin-left: 25%; margin-right: 25%;width: 50%;" onchange="chgSt();">
                                            <option value="" selected="">-Please choose an option-</option>
                                            <option value="R">-Remote-</option>
                                            <?php
                                            foreach ($data['states'] as $key => $value) {
                                              echo "<option value='".$key."'>".$value."</option>";
                                            }
                                            ?>
                                          </select>
                                          <div id="cities" tyle="width: 100%;padding-right: 40%;padding-left: 40%;"></div>
                                        </div>
                                      </form>
                                    </p>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end of text-container -->
                </div> <!-- end of col -->
            </div> <!-- end of row -->            
        </div> <!-- end of container -->

    </header> <!-- end of header -->
    <!-- end of header -->
<script>
function chgSt() {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", '<?=ROOT?>process/cities', true);
  //console.log('<?=ROOT?>');
  //Send the proper header information along with the request
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  var state = document.getElementById("state").value;
  xhr.onreadystatechange = function() { // Call a function when the state changes.
      if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
          document.getElementById("cities").innerHTML = this.responseText;                   
      }
  }
  xhr.send(state);
}
</script>
<?php $this->view("landlist/footer", $data); ?>