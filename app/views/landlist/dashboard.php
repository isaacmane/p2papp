<?php $this->view("landlist/header", $data); ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
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
                  <h5 class="card-title">Recent Post <span>| Latest</span></h5>

                  <!-- <table class="table table-borderless datatable">-->
                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th scope="col">Position</th>
                        <th scope="col">Date</th>
                        <th scope="col">Location</th>
                        <th scope="col">Vacancies</th>
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?= $data['tablepost']; ?>
                    </tbody>
                  </table>
                  <table><tr><td><b>Attention: If you have any pending post you won't be able to create another post</b></td></tr></table>
                </div>

              </div>
            </div><!-- End Recent Sales -->

      </div>
    </section>

  </main><!-- End #main -->

<?php $this->view("landlist/footer", $data); ?>