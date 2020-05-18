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
            <h1 class="h3 mb-0 text-gray-800">Edit Hotel</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo site_url() . "admin"; ?>">Home</a></li>
              <li class="breadcrumb-item">Manage Hotels</li>
              <li class="breadcrumb-item active" aria-current="page">Edit Hotel</li>
            </ol>
          </div>
          <!-- Edit Hotel (Main) -->
          <div class="row">
            <div class="col-lg-12">
              <!-- General Element -->
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Edit Hotel</h6>
                </div>
                <div class="card-body">
                  <?php validation_errors(); ?>
                  <?php echo form_open_multipart('admin/editHotel'); ?>
                  <div class="form-group">
                    <label for="exampleFormControlInput1">Hotel Name</label>
                    <input type="hidden" name='hotel_id' value="<?php echo $hotel['id']; ?>" />
                    <input type="text" name="name" value="<?php echo $hotel['name']; ?>" class="form-control" id="exampleFormControlInput1" placeholder="Bordeaux Le Grand Hotel? Fill me up!">
                    <?php echo form_error('name', '<small><p class="form-text text-danger">', '</small></p>'); ?>
                  </div>
                  <div class="form-group">
                    <label for="exampleFormControlInput2">Hotel Location</label>
                    <input type="text" name="location" value="<?php echo $hotel['location']; ?>" class="form-control" id="exampleFormControlInput2" placeholder="Bordeaux, France? Fill me up!">
                    <?php echo form_error('location', '<small><p class="form-text text-danger">', '</small></p>'); ?>
                  </div>
                  <div class="form-group">
                    <label for="exampleFormControlInput3">Hotel Star</label>
                    <input type="number" name="star" value="<?php echo $hotel['star']; ?>" class="form-control" id="exampleFormControlInput3" placeholder="5 stars, maybe? Fill me with numbers!">
                    <?php echo form_error('star', '<small><p class="form-text text-danger">', '</small></p>'); ?>
                  </div>
                  <div class="form-group">
                    <label for="exampleFormControlTextarea1">Headline</label>
                    <textarea class="form-control" name="headline" id="exampleFormControlTextarea1" rows="3" placeholder="Fill me with hotel headlines! Min is 10 characters, max is 30 characters!"><?php echo $hotel['headline']; ?></textarea>
                    <?php echo form_error('headline', '<small><p class="form-text text-danger">', '</small></p>'); ?>
                  </div>
                  <div class="form-group">
                    <label for="exampleFormControlTextarea2">Description</label>
                    <textarea class="form-control" name="description" id="exampleFormControlTextarea2" rows="3" placeholder="Fill me with hotel headlines! Min is 40 characters!"><?php echo html_escape($hotel['description']); ?></textarea>
                    <?php echo form_error('description', '<small><p class="form-text text-danger">', '</small></p>'); ?>
                  </div>
                  <div class="form-group">
                    <p>Hotel Thumbnail</p>
                    <div class="custom-file">
                      <input type="hidden" name="thumbnail_previous" value="<?php echo $hotel['picture']; ?>" />
                      <input type="file" name="picture" class="form-control-file" id="customFile">
                    </div>
                  </div>
                  <input type="submit" class="btn btn-primary" value="Edit Hotel Data" />
                  <?php echo form_close(); ?>
                </div>
              </div>
            </div>
          </div>
          <!-- Edit Hotel (Headline) -->
          <div class="row">
            <div class="col-lg-12">
              <!-- General Element -->
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Edit Hotel Headline</h6>
                </div>
                <div class="card-body">
                  <?php validation_errors(); ?>
                  <?php echo form_open_multipart('admin/editHotelHeadlines'); ?>
                  <div class="form-group">
                    <p>Hotel Headline #1</p>
                    <div class="custom-file">
                      <input type="hidden" name="hotel_id" value="<?php echo $hotel['id']; ?>"/>
                      <input type="hidden" name="prev_headline_pic_1" value="<?php echo $headlines[0]['headline_picture']; ?>">
                      <input type="file" name="headline_picture_1" class="form-control-file" id="customFile">
                    </div>
                  </div>
                  <div class="form-group">
                    <p>Hotel Headline #2</p>
                    <div class="custom-file">
                      <input type="hidden" name="prev_headline_pic_2" value="<?php echo $headlines[1]['headline_picture']; ?>">
                      <input type="file" name="headline_picture_2" class="form-control-file" id="customFile">
                    </div>
                  </div>
                  <div class="form-group">
                    <p>Hotel Headline #3</p>
                    <div class="custom-file">
                      <input type="hidden" name="prev_headline_pic_3" value="<?php echo $headlines[2]['headline_picture']; ?>">
                      <input type="file" name="headline_picture_3" class="form-control-file" id="customFile">
                    </div>
                  </div>
                  <input type="submit" class="btn btn-primary" value="Edit Hotel Headline Pictures" />
                  <?php echo form_close(); ?>
                </div>
              </div>
            </div>
          </div>
          <!-- Edit Hotel (Features) -->
          <div class="row">
            <div class="col-lg-12">
              <!-- General Element -->
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Edit Hotel Features</h6>
                </div>
                <div class="card-body">
                  <?php 
                    validation_errors(); 
                    echo form_open_multipart('admin/editHotelFeatures'); 
                    $counter = 0;
                  ?>
                  <input type="hidden" name="hotel_id" value="<?php echo $hotel['id']; ?>"/>
                  <?php foreach ($features as $feature) {
                    $name = "feature" . $counter;
                  ?>
                    <div class="form-group">
                      <label for="exampleFormControlInput6">Hotel Feature</label>
                      <input type="text" class="form-control" value="<?= $feature['feature'] ?>" name="<?= $name; ?>" id="exampleFormControlInput4" placeholder="Swimming pool? Breakfast in rooms? Or else?">
                    </div>
                  <?php 
                      $counter++;
                    } 
                  ?>
                  <input type="submit" class="btn btn-primary" value="Edit Hotel Feature" />
                  <?php echo form_close(); ?>
                </div>
              </div>
            </div>
          </div>
          <!---Container Fluid-->
        </div>
        <!-- Footer -->
        <?= $footer; ?>
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