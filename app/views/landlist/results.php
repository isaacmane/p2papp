<?php $this->view("landlist/header", $data); ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Find Jobs</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Results</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">            
            <!-- Recent Sales -->
            <div class="col-5" id="side-nav">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                    <div class="full">
                      <span class="srchparams">
                      <?php 
                        //echo $data["defaultrcd"];
                        //show($data);
                        if (isset($data["city"]) AND isset($data["state"]) AND isset($data["totalrecords"]) AND isset($data["term"])) {
                          echo $data["term"]." in ".$data["city"].", ".$data["state"]." / ".$data["totalrecords"]." jobs"; 
                        }                                               
                      ?>                        
                      </span>
                    </div>
                  <?php 
                  //echo "Data here:";
                  //show($data);
                  $html = '';
                  /*if (is_array($data['results'])) {
                    if (count($data['results']) > 0) {
                      foreach ($data['results'] as $key => $value) {
                        $html .= "<div class='card mb-4 box-shadow'>
                                    <div class='card-body' id='".$data['results'][$key]->id."' onclick='showFdesc(this.id)'>
                                      <h5 class=''>".$data['results'][$key]->position."</h5>
                                      <h6>".$data['results'][$key]->company."</h6>
                                      <h6>".$data['results'][$key]->CITY.", ".$data['results'][$key]->STATE_NAME."</h6>
                                      <h6>$".$data['results'][$key]->low." - $".$data['results'][$key]->high."<span> ".$data['results'][$key]->typejob."</span></h6>
                                      <span>".substr($data['results'][$key]->description,0 ,300)."...</span>
                                      <p></p>
                                    </div>
                                  </div>";                    
                      }  
                    } 
                  }else{
                    $html .= "No Results";
                  }*/

                  //show($data);
                  //echo $data["totalrecords"];
                  if(!empty($data["totalrecords"])){
                    //Navigation Multiple Results
                    $itemsPerPage = 5;
                    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                    $totalPages = ceil(count($data["results"]) / $itemsPerPage);
                    $offset = ($current_page - 1) * $itemsPerPage;
                    $currentPageItems = array_slice($data["results"], $offset, $itemsPerPage);
                    //show($currentPageItems);
                    // Display the items for the current page
                    //echo $html;
                    $html = '';
                    //show($currentPageItems);
                    if (is_array($currentPageItems)) {
                      if (count($currentPageItems) > 0) {
                        foreach ($currentPageItems as $key => $value) {
                          $html .= "<div class='card mb-4 box-shadow'>
                                      <div class='card-body' id='".$currentPageItems[$key]->id."' onclick='showFdesc(this.id)'>
                                        <h5 class=''>".$currentPageItems[$key]->position."</h5>
                                        <h6>".$currentPageItems[$key]->company."</h6>
                                        <h6>".$currentPageItems[$key]->CITY.", ".$currentPageItems[$key]->STATE_NAME."</h6>
                                        <h6>$".$currentPageItems[$key]->low." - $".$currentPageItems[$key]->high."<span> ".$currentPageItems[$key]->typejob."</span></h6>
                                        <span>".substr($currentPageItems[$key]->description,0 ,300)."...</span>
                                        <p></p>
                                      </div>
                                    </div>";                    
                        }  
                      } 
                    }

                    echo $html;
                    $wht = str_replace(" ", "+", $data['term']);
                    $whr = $data['city'].", ".$data['state'];
                    $whr = str_replace(" ", "+", $whr);
                    // Create navigation links
                    echo "<div class='pagination'>";
                    for ($i = 1; $i <= $totalPages; $i++) {
                        $activeClass = ($i == $current_page) ? 'active' : '';
                        if(empty($data["whr"])){
                          echo "<div class='lnkpage'><a class='$activeClass' href='?page=$i&wht=$wht'>$i</a></div>";
                        }else{
                          echo "<div class='lnkpage'><a class='$activeClass' href='?page=$i&wht=$wht&whr=$whr'>$i</a></div>";
                        }                        
                    }
                    echo "</div>";
                  }else{                    
                      $html .= "No Results<br>";
                      $html .= $_SESSION['validatefields'];
                      echo $html;
                  }
                  
                  ?>
                  
                </div>

              </div>
            </div><!-- End Recent Sales -->
            <div class="col-7">
              <div class="card recent-sales overflow-auto">
                <div class="card-body">
                  <div id="jobfullt"></div>
                  <!--<h5 class="card-title">Results <span></span></h5>-->
                </div>
              </div>
            </div>
      </div>
    </section>

  </main><!-- End #main -->
<script>
  function showFdesc(param) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", '<?=ROOT?>search/fullresult', true);

    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    //var state = document.getElementById("state").value;
    xhr.onreadystatechange = function() { // Call a function when the state changes.
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            document.getElementById("jobfullt").innerHTML = this.responseText;                  
        }
    }
    xhr.send(param);
  }
  showFdesc(<?php echo $data["defaultrcd"];?>);
</script
<?php $this->view("landlist/footer", $data); ?>