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
              <li class="breadcrumb-item active" aria-current="page">All Orders</li>
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
                        <th>UID</th>
                        <th>HID</th>
                        <th>RID</th>
                        <th>Rooms</th>
                        <th>Check In</th>
                        <th>Check Out</th>
                        <th>Price (Rp.)</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach ($orders as $order) {
                        $finish_order = site_url() . "admin/finishOrder/" . $order['id'];
                        echo "<tr>";
                          echo "<td>" . $order['user_id'] . "</td>";
                          echo "<td>" . $order['hotel_id'] . "</td>";
                          echo "<td>" . $order['room_id'] . "</td>";
                          echo "<td>" . $order['num_rooms'] . "</td>";
                          echo "<td>" . $order['date_check_in'] . "</td>";
                          echo "<td>" . $order['date_check_out'] . "</td>";
                          echo "<td>" . $order['price'] . "</td>";
                          if($order['finished'] == 0) {
                            echo "<td><span class='badge badge-danger'>Incomplete</span></td>";
                          }
                          else if($order['finished'] == 1) {
                            echo "<td><span class='badge badge-success'>Done</span></td>";
                          }
                          else {
                            echo "<td>" . $order['finished'] . "</td>";
                          }
                          if($order['finished'] == 0) {
                            echo "<td><a href=$finish_order><span class='badge badge-danger'>Finish</span></a></td>";
                          }
                          else {
                            echo "<td><span class='badge badge-success'>Finished</span></td>";
                          }
                        echo "</tr>";
                      }
                      ?>
                    </tbody>
                  </table>
                  <br>
                  <p>
                    Notes:<br>
                    UID: User ID<br>
                    HID: Hotel ID<br>
                    RID: Room ID
                  </p>
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