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
    <div class="modal fade" id="modalDeleteRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Delete Confirmation</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="<?php echo site_url() . "admin/deleteRoom"; ?>" method="POST">
            <div class="modal-body">
              <input type="hidden" name="room_id" value="">
              Are you certain to delete the room?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Delete</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Edit Modal -->
    <div class="modal fade exampleModalEdit" id="exampleModalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Edit Room Information</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="<?php echo site_url() . "admin/editRoom"; ?>" method="POST">
            <div class="modal-body">
              <input type="hidden" name="hotel_id" value="">
              <input type="hidden" name="room_id" value="">
              <div class="form-group">
                <label for="exampleFormControlInput1">Room Name</label>
                <input type="text" name="room_name" value="" class="form-control" id="exampleFormControlInput1" placeholder="The name of the room..." required>
                <?php echo form_error('name', '<small><p class="form-text text-danger">', '</small></p>'); ?>
              </div>
              <div class="form-group">
                <label for="exampleFormControlInput2">Room Availability</label>
                <input type="text" name="room_count" value="" class="form-control" id="exampleFormControlInput2" placeholder="Availability of the room..." required>
                <?php echo form_error('location', '<small><p class="form-text text-danger">', '</small></p>'); ?>
              </div>
              <div class="form-group">
                <label for="exampleFormControlInput3">Room Price</label>
                <input type="number" name="room_price" value="" class="form-control" id="exampleFormControlInput3" placeholder="Fill room price here..." required>
                <?php echo form_error('star', '<small><p class="form-text text-danger">', '</small></p>'); ?>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Edit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- New Room Modal -->
    <div class="modal fade" id="modalNewRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">New Room Information</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="<?php echo site_url() . "admin/newRoom"; ?>" method="POST">
            <div class="modal-body">
              <input type="hidden" name="hotel_id" value="">
              <div class="form-group">
                <label for="exampleFormControlInput1">Room Name</label>
                <input type="text" name="room_name" value="" class="form-control" id="exampleFormControlInput1" placeholder="The name of the room..." required>
                <?php echo form_error('name', '<small><p class="form-text text-danger">', '</small></p>'); ?>
              </div>
              <div class="form-group">
                <label for="exampleFormControlInput2">Room Availability</label>
                <input type="text" name="room_count" value="" class="form-control" id="exampleFormControlInput2" placeholder="Availability of the room..." required>
                <?php echo form_error('location', '<small><p class="form-text text-danger">', '</small></p>'); ?>
              </div>
              <div class="form-group">
                <label for="exampleFormControlInput3">Room Price</label>
                <input type="number" name="room_price" value="" class="form-control" id="exampleFormControlInput3" placeholder="Fill room price here..." required>
                <?php echo form_error('star', '<small><p class="form-text text-danger">', '</small></p>'); ?>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">New</button>
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
            <h1 class="h3 mb-0 text-gray-800">All Rooms</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo site_url() . "admin"; ?>">Home</a></li>
              <li class="breadcrumb-item">Tables</li>
              <li class="breadcrumb-item active" aria-current="page">All Rooms</li>
            </ol>
          </div>

          <!-- Row -->
          <div class="row">
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">All Rooms</h6>
                  <button class="btn btn-sm btn-info" data-toggle='modal' data-target='#modalNewRoom' data-hotel_id=<?= $hotel_id; ?>>New Room</button>
                </div>
                <div class="table-responsive p-3">
                  <table class="table text-center align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Available</th>
                        <th>Price</th>
                        <th>Edit</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach ($rooms as $room) {
                        $id = $room['id'];
                        $name = $room['room_name'];
                        $room_count = $room['room_count'];
                        $price = $room['price'];
                        $name = preg_replace('/\s+/', '_', $name);
                        echo "<tr>";
                          echo "<td>" . $id . "</td>";
                          echo "<td>" . $room['room_name'] . "</td>";
                          echo "<td>" . $room['room_count'] . "</td>";
                          echo "<td>" . number_format($room['price']) . "</td>";
                          echo "<td><button class='btn btn-sm btn-success' data-toggle='modal' data-target='#exampleModalEdit' data-room_id=$id data-hotel_id=$hotel_id data-room_name=$name data-room_count=$room_count data-price=$price id='#modalEdit'>Edit</button></td>";
                          echo "<td><button class='btn btn-sm btn-warning' data-toggle='modal' data-target='#modalDeleteRoom' data-room_id=$id id='#modalCenter'>Delete</button></td>";
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