<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Intractive &mdash; Your Reviews!</title>
  <?php echo $css; ?>
</head>

<body>
  <div class="container">
    <?= $navigation; ?>
    <div class="content">
      <?= $sidebar; ?>
      <main class="hotel-view">
        <div class="gallery">
          <figure class="gallery__item">
            <img src="<?php echo base_url() . $headlines[0]['headline_picture']; ?>" alt="Photo 1" class="gallery__photo">
          </figure>
          <figure class="gallery__item">
            <img src="<?php echo base_url() . $headlines[1]['headline_picture']; ?>" alt="Photo 2" class="gallery__photo">
          </figure>
          <figure class="gallery__item">
            <img src="<?php echo base_url() . $headlines[2]['headline_picture']; ?>" alt="Photo 3" class="gallery__photo">
          </figure>
        </div>
        <div class="overview">
          <h1 class="overview__heading"><?php echo $hotel[0]['name']; ?></h1>
          <div class="overview__stars">
            <?php
            for ($i = 0; $i < $hotel[0]['star']; $i++) {
              echo "
                <svg class='overview__icon-star'>
                  <use xlink:href='" . base_url() . "/assets/images/svg/sprite.svg#icon-star'></use>
                </svg>
                ";
            }
            ?>
          </div>
          <div class="overview__location">
            <svg class="overview__icon-location">
              <use xlink:href="<?php echo base_url() . "/assets/images/svg/sprite.svg#icon-location-pin"; ?>"></use>
            </svg>
            <button class="btn-inline"><?php echo $hotel[0]['location']; ?></button>
          </div>
          <div class="overview__rating">
            <div class="overview__rating-average"><?php echo $hotel[0]['rating']; ?></div>
            <div class="overview__rating-count"><?= $votes; ?> votes</div>
          </div>
        </div>
        <div class="detail">
          <div class="description">
            <h3 class="paragraph--center">
              <?php
                echo $hotel[0]['headline'];
              ?>
            </h3><br/>
            <p class="paragraph">
              <?php
              echo $hotel[0]['description'];
              ?>
            </p>
            <ul class='list'>
              <?php
              for ($i = 0; $i < $hotel['count_feature']; $i++) {
                echo "
                    <li class='list__item'>" . $hotel[$i]['feature'] . "</li>
                  ";
              }
              ?>
            </ul>
            <!--
            <div class="recommend">
              <p class="paragraph__count">
                Nicholas and 5 other friends recommend this place!
              </p>
              <div class="recommend__friends">
                <img src="assets/images/photos/user-3.jpg" alt="Friend 3" class="recommend__photo">
                <img src="assets/images/photos/user-4.jpg" alt="Friend 4" class="recommend__photo">
                <img src="assets/images/photos/user-5.jpg" alt="Friend 5" class="recommend__photo">
                <img src="assets/images/photos/user-6.jpg" alt="Friend 6" class="recommend__photo">
              </div>
            </div>
            -->
          </div>
          <div class="user-order">
            <figure class="user-order__figure">
              <blockquote class="user-order__figure__text">
                <h1 class='user-order__figure__heading'>Rooms</h1>
                <ul class="list">
                  <?php
                    foreach($rooms as $room) {
                      $room_name = $room['room_name'];
                      $available = $room['room_count'];
                      $price = number_format($room['price']);
                      echo "<li class='list__item--oneline'>$room_name (Rp. $price)</li>";
                      echo "<li class='list__item--indented'>$available rooms available!</li>";
                    }
                  ?>
                </ul>
              </blockquote>
            </figure>
            <figure class="user-order__figure">
              <blockquote class="user-order__figure__text">
                <h1 class='user-order__figure__heading'>Book</h1>
                <p class='paragraph'>Book your own personal hotel room by filling the form below!</p>
                <?php
                if ($rooms === FALSE) {
                  echo "<p class='paragraph'>We are sorry, but there are no rooms available!</p>";
                }
                else {
                  validation_errors();
                ?>
                  <form action="<?php echo site_url() . "booking/confirmBooking"; ?>" class='form_booking' method="POST">
                    <p class="paragraph--bold-colored">Hotel:</p>
                    <input type="text" name='hotel_name' class='form-booking__input--readonly' value="<?php echo $hotel[0]['name']; ?>" readonly>
                    <p class="paragraph--bold-colored">Rooms:</p>
                    <input type="number" name='num_rooms' class='form-booking__input' placeholder="Number of rooms..." required>
                    <?php echo form_error('num_rooms'); ?>
                    <p class="paragraph--bold-colored">Check In:</p>
                    <input id="check_in_date" type="date" name='date_check_in' class='form-booking__input' required>
                    <?php echo form_error('date_check_in'); ?>
                    <p class="paragraph--bold-colored">Check Out:</p>
                    <input id="check_out_date" type="date" name='date_check_out' class='form-booking__input' required>
                    <?php echo form_error('date_check_out'); ?>
                    <p class="paragraph--bold-colored">Rooms Type:</p>
                    <select name="room" class='form-booking__input' required>
                      <?php
                      foreach ($rooms as $room) {
                        echo "<option value='" . $room['room_name'] . "'>" . $room['room_name'] . "</option>";
                      }
                      ?>
                    </select><br>
                    <?php echo form_error('room'); ?>
                    <input type="submit" value="Book Now!" class='btn-inline u-center-text'>
                  </form>
                  <?php
                    $error_message = $this->session->flashdata('message');
                    echo "<p class='paragraph'>$error_message</p>";
                  ?>
              </blockquote>
            </figure>
          <?php
                }
          ?>
          </div>
        </div>
      </main>
    </div>
  </div>

  <!-- Same laziness. Add this to Intractive.js when all is over. -->
  <script>
    let today = new Date().toISOString().substr(0, 10);
    document.querySelector("#check_in_date").value = today;
  </script>

</body>

</html>