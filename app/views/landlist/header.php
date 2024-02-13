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

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="<?=ASSETS?>img/logo.png" alt="">
        <span class="d-none d-lg-block"></span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <div class="wsearch">
          <?php 
          $term = $city = $state = $lct = '';
          if(isset($data["term"])){ $term = $data["term"]; }        
          if(isset($data["state"])){ $state = $data["state"]; }  
          if(isset($data["city"])){ $city = $data["city"]; }  
          if(isset($state)){
            if (!empty($city)) {
              $lct = $city.", ".$state;
            }
          }
          ?>
          <input type="text" class="form-control" id="wsearchbox" name="query" placeholder="What" title="Enter search keyword" style="margin-right: 2%;" onkeyup="whatSrch(this.value)" onblur = "lsgFoc(this.id)" onclick="whatSrch(this.value)" value="<?php echo $term; ?>">
          <div id="whatlist"></div>
        </div>
        <div class="wheresearch">
          <input type="text" class="form-control" id="wheresearchbox" name="query" placeholder="Where" title="Enter search keyword" style="margin-right: 2%;" onkeyup="whereSrch(this.value)" onblur = "lsgFoc(this.id)" onclick="whereSrch(this.value)" value="<?php echo $lct; ?>">
          <div id="wherelist"></div>
        </div>
        <button type="button" title="Search" onclick="searchP()">Search</button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
       <ul class="d-flex align-items-center">

        <!--<li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li>

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <span class="badge bg-primary badge-number">4</span>
          </a>

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
              You have 4 new notifications
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-exclamation-circle text-warning"></i>
              <div>
                <h4>Lorem Ipsum</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>30 min. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-x-circle text-danger"></i>
              <div>
                <h4>Atque rerum nesciunt</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>1 hr. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-check-circle text-success"></i>
              <div>
                <h4>Sit rerum fuga</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>2 hrs. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-info-circle text-primary"></i>
              <div>
                <h4>Dicta reprehenderit</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>4 hrs. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>
            <li class="dropdown-footer">
              <a href="#">Show all notifications</a>
            </li>

          </ul>

        </li>

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-chat-left-text"></i>
            <span class="badge bg-success badge-number">3</span>
          </a>

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
            <li class="dropdown-header">
              You have 3 new messages
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="<?=ASSETS?>img/messages-1.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>Maria Hudson</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>4 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="<?=ASSETS?>img/messages-2.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>Anna Nelson</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>6 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="<?=ASSETS?>img/messages-3.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>David Muldon</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>8 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="dropdown-footer">
              <a href="#">Show all messages</a>
            </li>

          </ul>

        </li>
        -->
        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <!--<img src="<?=ASSETS?>img/profile-img.jpg" alt="Profile" class="rounded-circle">-->
            <span class="d-none d-md-block dropdown-toggle ps-2"><?=$_SESSION['user_name']?></span>
          </a>

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              
              <h6><?=$_SESSION['user_name']?></h6>
              <span>Web Designer</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="<?=ROOT?>profile">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="<?=ROOT?>profile">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                <i class="bi bi-question-circle"></i>
                <span>Need Help?</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="<?=ROOT?>logout">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul>
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="<?=ROOT?>dashboard">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Post</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?=ROOT?>posting">
              <i class="bi bi-circle"></i><span>New Post</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->

      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?=ROOT?>profile">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?=ROOT?>logout">
          <i class="bi bi-box-arrow-right"></i>
          <span>Sign Out</span>
        </a>
      </li>
      <!-- End Profile Page Nav -->
    </ul>

  </aside><!-- End Sidebar-->

  <script>
    function hideInfo() {
      if (window.event.srcElement.id != 'whatlist') {
          document.getElementById('whatlist').style.display = 'none';
      }
      if (window.event.srcElement.id != 'wherelist') {
          document.getElementById('wherelist').style.display = 'none';
      }
    }

    document.onclick = hideInfo;

    function whatSrch(v){
      var whl = document.getElementById("wherelist");
      whl.style.display = "none";

      var xhr = new XMLHttpRequest();
      xhr.open("POST", '<?=ROOT?>search/whatSrch', true);      

      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function() { // Call a function when the state changes.
          if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            document.getElementById("whatlist").innerHTML = this.responseText; 
            var wl = document.getElementById("whatlist");
            wl.style.display = "block";                               
          }
      }
      xhr.send(v);
    }

    function whereSrch(v){
      var wl = document.getElementById("whatlist");
      wl.style.display = "none";

      var xhr = new XMLHttpRequest();
      xhr.open("POST", '<?=ROOT?>search/whereSrch', true); 

      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function() { // Call a function when the state changes.
          if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            document.getElementById("wherelist").innerHTML = this.responseText;  
            var whl = document.getElementById("wherelist");
            whl.style.display = "block";                      
          }
      }
      xhr.send(v);
    }

    function searchP(){
      var what = document.getElementById("wsearchbox").value;
      what = what.replace(/ /g, "+");
      var where = document.getElementById("wheresearchbox").value;
      where = where.replace(/ /g, "+");
      var variables = "wht="+what+"&"+"whr="+where;
      window.location.href = "<?=ROOT?>search/jobs?"+variables;
    }

    function lsgFoc(p){
      //desc('*');
      //descwhere('*');
    }    

    function desc(v){  
      document.getElementById("wsearchbox").value = v;
      var wl = document.getElementById("whatlist");
      wl.style.display = "none";              
    }

    function descwhere(v){   
      document.getElementById("wheresearchbox").value = v;
      var wl = document.getElementById("wherelist");
      wl.style.display = "none";
    }

  </script>