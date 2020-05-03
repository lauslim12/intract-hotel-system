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
		<?php
			echo $navigation;
		?>

		<div class="content">
      <?php
        echo $sidebar;
      ?>
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
              for($i = 0; $i < $hotel[0]['star']; $i++) {
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
            <div class="overview__rating-count">888 votes</div>
          </div>
        
        </div>
        
        <div class="detail">
          <div class="description">
            
            <p class="paragraph">
              <?php
                echo $hotel[0]['description'];
              ?>
            </p>

            <ul class='list'>
              <?php
                for($i = 0; $i < $hotel['count_feature']; $i++) {
                  echo "
                    <li class='list__item'>". $hotel[$i]['feature'] . "</li>
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
                <h1 class='user-order__figure__heading'>Book</h1>
                Book your own personal hotel room by filling the form below!
                
                <?php
                  if($rooms === FALSE) {
                    echo "<p class='paragraph'>We are sorry, but there is no rooms available!</p>";
                  }
                  // I actually despise doing this.
                  else {
                ?>

                <form action="<?php echo site_url() . "/booking/confirmBooking"; ?>" method="POST">
                  <input type='hidden' name='hotel_id' value="<?php echo $id; ?>" readonly>
                  <input type="text" name='hotel_name' value="<?php echo $hotel[0]['name']; ?>" readonly>
                  <input type="number" name='num_rooms' placeholder="Number of rooms..." required>
                  <input type="number" name='duration' placeholder="Duration..." required>
                  <select name="room" required>
                    <?php 
                      foreach($rooms as $room) {
                        echo "<option value='" . $room['room_name'] . "'>" . $room['room_name'] . "</option>";
                      }
                    ?>
                  </select>
                  <input type="submit" value="Book Now!">
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
</body>

</html>