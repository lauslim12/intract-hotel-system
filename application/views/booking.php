<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                During a trip to France this summer, I spent my last holiday using Intractive Hotel System.
                I'd actually used different online booking platforms, but when it comes to the services, Intractive Hotel System gives me the best experience!
              </blockquote>
              <figcaption class="review__user">
                <img src="<?php echo base_url() . "/assets/images/reviewers/reviewer-1.jpg"; ?>" alt="Photo of reviewer 1" class="review__photo">
                <div class="review__user-box">
                  <p class="review__user-name">Nicholas Dwiarto</p>
                  <p class="review__user-date">Dec 31st, 2019</p>
                </div>
                <div class="review__rating">9.5</div>
              </figcaption>
            </figure>
            <figure class="review">
              <blockquote class="review__text">
                Intractive Hotel System gives me sleek booking system, and it is extremely easy to use this system! I love using this system and will use this again on my next holiday!
              </blockquote>
              <figcaption class="review__user">
                <img src="<?php echo base_url() . "/assets/images/reviewers/reviewer-2.jpg"; ?>" alt="Photo of reviewer 2" class="review__photo">
                <div class="review__user-box">
                  <p class="review__user-name">Marie Julis-Alexia</p>
                  <p class="review__user-date">Jan 1st, 2020</p>
                </div>
                <div class="review__rating">9</div>
              </figcaption>
            </figure>
          </div>
        </div>
        <div class="detail">
          <div class="description--posts">
            <h2>REVIEWS</h2>
            <form action='<?php echo site_url() . "review/submitPost"; ?>' method="POST" enctype='multipart/form-data' class='post-form'>
              <input type="hidden" name="hotel_id" value="<?= $id; ?>">
              <input type="file" name="fileToUpload" id="fileToUpload" />
              <textarea name="post_text" id="post_text" rows="5" placeholder="A penny for your thoughts? Or want to share something with an image?"></textarea>
              <input type="submit" value="Post" name="post" id="post_button" class="btn-inline">
            </form>
            <div class="posts-area">
              <?php
              /* 
              *  Knapsack
              */
                for($i = 0; $i < count($reviews); $i++) {
                  $profile_pic = base_url() . $user_reviews[$i]['profile_pic'];
                  $added_by = site_url() . "profile/view/" . $user_reviews[$i]['username'];
                  $first_name = $user_reviews[$i]['first_name'];
                  $last_name = $user_reviews[$i]['last_name'];
                  $time_message = $reviews[$i]['date_added'];
                  $image_path = base_url() . $reviews[$i]['image'];
                  $body = $reviews[$i]['body'];
                  $like_count = $reviews[$i]['likes'];
                  $post_id = $reviews[$i]['id'];
                ?>
                <div class='status-post'>
                  <div class='status-post__profile-pic'>
                    <img src='<?= $profile_pic; ?>' width='50'>
                  </div>
                  <div class='status-post__posted-by'>
                    <a class='link' href='<?= $added_by; ?>'><?= $first_name . " " . $last_name; ?></a>
                    <p class='paragraph'><?= $time_message; ?></p>
                  </div>
                </div>
                <div class='status-post__body'>
                  <div class='status-post__image'>
                    <?php 
                      if($reviews[$i]['image'] != NULL) {
                        echo "<img src='$image_path' />";
                      }
                    ?>
                    <p class='paragraph'>
                      <?= $body; ?>
                    </p>
                  </div>
                </div>
                <div class="status-post">
                  <div class="status-post__comments">
                    <p>Comment</p>
                  </div>
                  <div class="status-post__likes">
                    <p><a href="<?= site_url() . "review/addLike/$post_id"; ?>">Like (<?= $like_count; ?>)</a></p>
                  </div>
                </div>
                <hr>
              <?php
                }
              ?>
            </div>
          </div>
        </div>
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
</body>

</html>