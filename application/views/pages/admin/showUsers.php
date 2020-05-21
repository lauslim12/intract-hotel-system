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
  <!-- Delete Modal -->
  <div class="modal fade" id="modalDeleteUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Delete Confirmation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?php echo site_url() . "admin/deleteUser"; ?>" method="POST">
          <div class="modal-body">
            <input type="hidden" name="user_id" value="">
            Are you certain to delete this user? This action cannot be undone and must be done under supervision of Nicholas Dwiarto.
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Delete</button>
          </div>
        </form>
      </div>
    </div>
  </div>
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
            <h1 class="h3 mb-0 text-gray-800">All Users</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo site_url() . "admin"; ?>">Home</a></li>
              <li class="breadcrumb-item">Tables</li>
              <li class="breadcrumb-item active" aria-current="page">All Users</li>
            </ol>
          </div>

          <!-- Row -->
          <div class="row">
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">All Users</h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table text-center align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                        <th>UID</th>
                        <th>Username</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Privilege</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach ($users as $user) {
                        $id = $user['id'];
                        echo "<tr>";
                          echo "<td>" . $user['id'] . "</td>";
                          echo "<td>" . $user['username'] . "</td>";
                          echo "<td>" . $user['first_name'] . " " . $user['last_name'] . "</td>";
                          echo "<td>" . $user['email'] . "</td>";
                          if ($user['privilege_level'] == 0) {
                            echo "<td><span class='badge badge-danger'>User</span></td>";
                            echo "<td><button class='btn btn-sm btn-warning' data-toggle='modal' data-target='#modalDeleteUser' data-user_id=$id>Delete</button></td>";
                          }
                          else if (($user['username'] == "nicholasnwr") || ($user['first_name'] == "Nicholas" && $user['last_name'] == "Dwiarto")) {
                            echo "<td><span class='badge badge-success'>Nicholas Dwiarto</span></td>";
                            echo "<td><button class='btn btn-sm btn-warning' id='deleteNicholas'>Delete</button></td>";
                          } 
                          else if ($user['privilege_level'] == 1) {
                            echo "<td><span class='badge badge-success'>Admin</span></td>";
                            echo "<td><button class='btn btn-sm btn-warning' data-toggle='modal' data-target='#modalDeleteUser' data-user_id=$id>Delete</button></td>";
                          }
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