<?php 
  defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Intractive &mdash; Your Profile</title>
  <?php echo $css; ?>
</head>

<body>
  <div class="container">
    <?= $navigation; ?>
    <div class="content">
      <?= $sidebar; ?>
      <main class="hotel-view">
        <div class="profile-detail detail">
          <div class="profile__container">
            <div class="profile">
              <div class="profile__profile-picture">
                <img src="<?php echo base_url() . $user_data['profile_pic']; ?>" alt="">
              </div>
              <div class="profile__content">
                <?php echo "<p class='paragraph--bold'>" . $user_data['first_name'] . " " . $user_data['last_name'] . "</p>"; ?>
                <?php echo "<p class='paragraph'>" . $user_data['birthdate'] .  "</p>"; ?>
                <div class="profile__text-gallery">
                  <p class='profile__text-gallery__text-par'>Posts <?= $user_posts; ?></p>
                  <p class='profile__text-gallery__text-par'>Likes 0</p>
                  <p class='profile__text-gallery__text-par'>Friends 0</p>
                  <p class='profile__text-gallery__text-par'>Reputation 0</p>
                </div>
                <a href="<?php echo site_url(); ?>">Return to Home</a>
              </div>
            </div>
            <?php
              if($user_data['username'] === $this->session->userdata('username')) {
                $username = $user_data['username'];
            ?>
              <div class="profile__change-picture">
                <?php validation_errors(); ?>
                <?php echo form_open_multipart('profile/changeUserData'); ?>
                  <p class='paragraph--center'>Change your user data here! You cannot change your username, date of birth, and gender.</p>
                  <p class="paragraph--bold-colored">First Name:</p>
                  <input type="text" name="first_name" class="form-booking__input" value="<?= $user_data['first_name']; ?>" required>
                  <?php echo form_error('first_name'); ?>
                  <p class="paragraph--bold-colored">Last Name:</p>
                  <input type="text" name="last_name" class="form-booking__input" value="<?= $user_data['last_name']; ?>" required>
                  <?php echo form_error('last_name'); ?>
                  <p class="paragraph--bold-colored">Email:</p>
                  <input type="text" name="email" class="form-booking__input" value="<?= $user_data['email']; ?>" required>
                  <?php echo form_error('email'); ?>
                  <p class="paragraph--bold-colored">Password:</p>
                  <input type="hidden" name="password_prev" value="<?= $user_data['password']; ?>">
                  <input type="text" name="password" class="form-booking__input" placeholder="Change your password here!">
                  <input type='submit' value='Change Profile Data' name='submit' class='btn-inline'>
                  <?php echo form_close(); ?>
              </div>
              <div class='profile__change-picture'>
                <?php echo form_open_multipart('profile/uploadDisplayPicture'); ?>
                  <p class='paragraph'>Change your profile picture here:</p>
                  <input type='file' name='fileToUpload' class="form-booking_input" id='fileToUpload'><br/>
                  <input type='submit' value='Upload Image' name='submit' class='btn-inline'>
                <?php echo form_close(); ?>
              </div>
            <?php
              }
            ?>
          </div>
        </div>
        <div class="profile-detail detail">
          <div class="profile__container">
            <div class="profile">
              <?php
                if($user_hotel !== FALSE && $this->session->userdata('username') === $user_data['username']) {
              ?>
              <h2>My Transactions</h2>
              <table class='profile__table'>
                <thead class='profile__table__header'>
                  <th class='table-text'>OID</th>
                  <th class='table-text'>Hotel</th>
                  <th class='table-text'>Type</th>
                  <th class='table-text'>Rooms/Nights</th>
                  <th class='table-text'>Price</th>
                  <th class='table-text'>Action</th>
                  <th class="table-text">Rating</th>
                </thead>
                <tbody class='profile__table__body'>
                  <?php
                    /*  Combine joined arrays by its primary keys / foreign keys.
                    *   The length of the array should be same, as it's a simple logic - one cannot have more rooms that one had ordered.
                    *   Algorithm: Knapsack. Can't believe I have to use this in web development.
                    */
                    for($i = 0; $i < count($user_hotel); $i++) {
                      $order_id = $transaction_data[$i]['id'];
                      $hotel_name = $user_hotel[$i]['name'];
                      $room_name = $user_rooms[$i]['room_name'];
                      $duration = $user_hotel[$i]['duration'];
                      $price = number_format($user_hotel[$i]['price']);
                      $num_rooms = $user_hotel[$i]['num_rooms'];
                      $status = $transaction_data[$i]['finished'];
                      $rating = $transaction_data[$i]['rating'];
                      $path_to_finish = site_url() . "booking/finishBooking/$order_id";

                      echo "<tr>";
                        echo "<td class='table-text'>$order_id</td>";
                        echo "<td class='table-text'>$hotel_name</td>";
                        echo "<td class='table-text'>$room_name</td>";
                        echo "<td class='table-text'>$num_rooms/$duration</td>";
                        echo "<td class='table-text'>$price</td>";
                        if($status == 0) {
                          echo "<td class='table-text'><a href=$path_to_finish>Finish Order!</a></td>";
                          echo "<td class='table-text'>None</td>";
                        }
                        else {
                          echo "<td class='table-text'>Finished!</td>";
                          echo "<td class='table-text'>$rating/10</td>";
                        }
                      echo "</tr>";
                    }
                  ?>
                </tbody>
              </table>
              <p class="paragraph u-margin-top">
                * OID means Order ID.<br/>
                * Price is in Indonesian Rupiah (IDR)!
              </p>
              <?php
                }
                else if($this->session->userdata('username') !== $user_data['username']) {
                  echo "<h2>You cannot see someone else's transaction history!</h2>";
                }
                else {
                  echo "<h2>You currently have no transactions!</h2>";
                }
              ?>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
</body>

</html>