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
            <h1 class="h3 mb-0 text-gray-800">Detail Hotel</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo site_url() . "admin"; ?>">Home</a></li>
              <li class="breadcrumb-item">Tables</li>
              <li class="breadcrumb-item active" aria-current="page">Detail Hotel</li>
            </ol>
          </div>

          <!-- Row -->
          <div class="row">
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Detail Hotel</h6>
                </div>
                <div class="card-body">
                  <h5 class="text-center">Essential Information</h5>
                  <p class="text-center">If you wish to check the information about hotel rooms, please check the 'Room Info' section.</p>
                  <div class="text-center">
                    <img src="<?php echo base_url() . $hotel['picture']; ?>" alt="Hotel Picture" class="hotel-picture-detail">
                  </div>
                  <p>Hotel name: <?= $hotel['name']; ?></p>
                  <p>Location: <?= $hotel['location']; ?></p>
                  <p>Headline: <?= $hotel['headline']; ?></p>
                  <p>Description: <?= $hotel['description']; ?></p>
                  <p>Rating: <?= $hotel['rating']; ?></p>
                  <p>Star: <?= $hotel['star']; ?></p>
                  <h5 class="text-center">Features</h5>
                  <ul>
                    <?php foreach($features as $feature) {
                      $feature = $feature['feature'];
                      echo "<li>$feature</li>";
                    }
                    ?>
                  </ul>
                  <h5 class="text-center">Headlines</h5>
                  <div class="text-center">
                    <img src="<?php echo base_url() . $headlines[0]['headline_picture']; ?>" alt="Headline 1" class="detail-img">
                    <img src="<?php echo base_url() . $headlines[1]['headline_picture']; ?>" alt="Headline 2" class="detail-img">
                    <img src="<?php echo base_url() . $headlines[2]['headline_picture']; ?>" alt="Headline 3" class="detail-img">
                  </div>
                  <div class="text-center">
                    <a href="<?php echo site_url() . "admin/showData"; ?>"><button class="btn btn-primary">Back to All Hotels</button></a>
                  </div>
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