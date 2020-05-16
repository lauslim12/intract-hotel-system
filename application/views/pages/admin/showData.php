<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="<?php echo base_url() . "assets/images/icons/favicon.png"; ?>" rel="shortcut icon">

  <title>Intractive &mdash; Administrator</title>
  
  <link href="<?php echo base_url() . "assets/vendors/fontawesome-free/css/all.min.css"; ?>" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url() . "assets/vendors/bootstrap/css/bootstrap.min.css"; ?>" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url() . "assets/vendors/datatables/dataTables.bootstrap4.min.css"; ?>" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url() . "assets/css/ruang-admin.css"; ?>" rel="stylesheet">
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <?= $sidebar; ?>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        <?= $header; ?>
        <!-- Topbar -->

        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">DataTables</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo site_url() . "admin"; ?>">Home</a></li>
              <li class="breadcrumb-item">Manage Hotels</li>
              <li class="breadcrumb-item active" aria-current="page">All Hotels</li>
            </ol>
          </div>

          <!-- Row -->
          <div class="row">
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">All Hotels</h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Headline</th>
                        <th>Rating</th>
                        <th>Star</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Headline</th>
                        <th>Rating</th>
                        <th>Star</th>
                        <th>Action</th>
                      </tr>
                    </tfoot>
                    <tbody>
                      <?php
                        foreach($hotels as $hotel) {
                          echo "<tr>";
                            echo "<td>" . $hotel['name'] . "</td>";
                            echo "<td>" . $hotel['location'] . "</td>";
                            echo "<td>" . $hotel['headline'] . "</td>";
                            echo "<td>" . $hotel['rating'] . "</td>";
                            echo "<td>" . $hotel['star'] . "</td>";
                            echo "<td>Action</td>";
                          echo "</tr>";
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!---Container Fluid-->
      </div>

      <!-- Footer -->
      <?= $footer ?>
      <!-- Footer -->
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="<?php echo base_url() . "assets/vendors/jquery/jquery.min.js"; ?>"></script>
  <script src="<?php echo base_url() . "assets/vendors/bootstrap/js/bootstrap.bundle.min.js"; ?>"></script>
  <script src="<?php echo base_url() . "assets/vendors/jquery-easing/jquery.easing.min.js"; ?>"></script>
  <script src="<?php echo base_url() . "assets/js/ruang-admin.js"; ?>"></script>
  <script src="<?php echo base_url() . "assets/vendors/chart.js/Chart.min.js"; ?>"></script>
  <script src="<?php echo base_url() . "assets/js/vendors/demo/chart-area-demo.js"; ?>"></script>  
</body>

</html>