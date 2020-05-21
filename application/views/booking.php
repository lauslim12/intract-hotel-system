<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Intractive &mdash; Your Hotel</title>
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

            <!-- Add reccommendation later
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
          <div class="user-reviews">
            <figure class="review">
              <blockquote class="review__text">
                During a trip to France this summer, I spent my last night at the InterContinental Bordeaux Le Grand Hôtel.
                I’d actually stayed there several years before when it was part of Regent Hotels, but was eager to stay again now that it’s part of IHG.
              </blockquote>
              <figcaption class="review__user">
                <img src="<?php echo base_url() . "/assets/images/reviewers/reviewer-1.jpg"; ?>" alt="Photo of reviewer 1" class="review__photo">
                <div class="review__user-box">
                  <p class="review__user-name">Nicholas Dwiarto</p>
                  <p class="review__user-date">Dec 31st, 2019</p>
                </div>
                <div class="review__rating">4.5</div>
              </figcaption>
            </figure>
            <figure class="review">
              <blockquote class="review__text">
                Our view overlooked one of the hotel’s central courtyards, which was nice and quiet, and the windows actually opened, so we could enjoy some fresh air.
              </blockquote>
              <figcaption class="review__user">
                <img src="<?php echo base_url() . "/assets/images/reviewers/reviewer-2.jpg"; ?>" alt="Photo of reviewer 2" class="review__photo">
                <div class="review__user-box">
                  <p class="review__user-name">Marie Julis-Alexia</p>
                  <p class="review__user-date">Jan 1st, 2020</p>
                </div>
                <div class="review__rating">4.75</div>
              </figcaption>
            </figure>
          </div>
        </div>
        <!-- 
        <div class="detail">
          <div class="description--posts">
            <h2>REVIEWS</h2>
            <form action='' method="POST" enctype='multipart/form-data' class='post-form'>
              <input type="file" name="fileToUpload" id="fileToUpload" />
              <textarea name="post_text" id="post_text" rows="5" placeholder="A penny for your thoughts? Or want to share something with an image?"></textarea>
              <input type="submit" value="Post" name="post" id="post_button" class="btn-inline">
            </form>
            <div class="posts-area">
              Placeholder Div
            </div>
            <img class="posts-area--loading" src="assets/images/icons/loading.gif" alt="Loading Icon">
          </div>
        </div>
        -->
        <?php
        $booking_url = site_url() . "booking/showBooking/$id";
        if ($rooms != FALSE) {
        ?>
          <div class="cta">
            <h2 class="cta__book-now">
              Good news! Rooms available for you right now!
            </h2>
            <button class="btn">
              <span class="btn__visible">Book now!</span>
              <span class="btn__invisible">
                <a href="<?php echo $booking_url; ?>">Only a few left!</a>
              </span>
            </button>
          </div>
        <?php
        } else {
        ?>
          <div class="cta">
            <h2 class="cta__book-now">
              We're sorry, but all rooms seems to be sold out on this hotel &#128530;
            </h2>
          </div>
        <?php
        }
        ?>
      </main>
    </div>
  </div>

  <!--
  <p>booking</p>
  <p>hotel pilihan anda: </p>

  <p>id: <?php echo $id; ?></p>

  <hr>
  <p>nama: <?php echo $hotel[0]['name']; ?></p>
  <p>lokasi: <?php echo $hotel[0]['location']; ?></p>
  <p>deskripsi: <?php echo $hotel[0]['description']; ?></p>
  <p>rooms: <?php echo $hotel[0]['rooms']; ?></p>
  <p>price: <?php echo $hotel[0]['price']; ?></p>

  <hr>
  
  <form action="<?php echo site_url() . "/booking/orderHotel/$id"; ?>" method="POST">
    <p>berapa kamar yang anda mau</p>
    <input type="text" name="room_count">
    <input type="hidden" name="price" value="<?php echo $hotel[0]['price']; ?>">
    <input type="hidden" name="rooms" value="<?php echo $hotel[0]['rooms']; ?>">

    <input type="submit" value="Submit">
  </form>
  -->

</body>

</html>