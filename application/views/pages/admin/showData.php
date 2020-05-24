<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Intractive &mdash; Administrator</title>
  <?= $css; ?>
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Delete Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Delete Confirmation</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="<?php echo site_url() . "admin/deleteHotel"; ?>" method="POST">
            <div class="modal-body">
              <input type="hidden" name="hotel_id" value="">
              Are you certain to delete the hotel data? This will REMOVE ALL of the FEATURES and ROOMS! Please be certain!
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Delete</button>
            </div>
          </form>
        </div>
      </div>
    </div>

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
            <h1 class="h3 mb-0 text-gray-800">All Hotels</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo site_url() . "admin"; ?>">Home</a></li>
              <li class="breadcrumb-item">Tables</li>
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
                  <table class="table text-center align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Detail</th>
                        <th>Edit Hotel</th>
                        <th>Delete</th>
                        <th>Room Info</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach ($hotels as $hotel) {
                        $id = $hotel['id'];
                        $path_to_hotel = site_url() . "admin/showEditHotel/$id";
                        $path_to_room = site_url() . "admin/showEditRoom/$id";
                        $path_to_detail = site_url() . "admin/showDetailHotel/$id";
                        echo "<tr>";
                          echo "<td>" . $id . "</td>";
                          echo "<td>" . $hotel['name'] . "</td>";
                          echo "<td><a href='$path_to_detail'><button class='btn btn-sm btn-primary'>Detail</button></a></td>";
                          echo "<td><a href='$path_to_hotel'><button class='btn btn-sm btn-success'>Edit Hotel</button></a></td>";
                          echo "<td><button class='btn btn-sm btn-warning' data-toggle='modal' data-target='#exampleModalCenter' data-hotel_id=$id id='#modalCenter'>Delete</button></td>";
                          echo "<td><a href='$path_to_room'><button class='btn btn-sm btn-info'>Room Info</button></a></td>";
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

  <?= $js; ?>
</body>

</html>