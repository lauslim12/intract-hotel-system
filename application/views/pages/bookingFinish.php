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
    <?php
      echo $navigation;
    ?>

    <div class="content">
      <?php
        echo $sidebar;
      ?>

      <main class="hotel-view">
        <div class="profile-detail detail">
          <div class="profile__container">

            <div class="profile">
              <form action="<?php echo site_url() . "booking/confirmFinishBooking"; ?>" method="POST">
                <input type='hidden' name='order_id' value="<?php echo $id; ?>">
                <input type="hidden" name='room_id' value="<?php echo $rooms['room_id']; ?>">
                <input type='hidden' name='ordered_rooms' value="<?php echo $rooms['num_rooms']; ?>"> 
                <h2>Payment</h2>
                <input type="number" name='payment' placeholder="Pay..." required>
                <h2>Rating</h2>
                <select name="rating" required>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                  <option value="10">10</option>
                </select>
                <br><br>
                <input type="submit" value="Finish!">
                <?php
                  $error_message = $this->session->flashdata('error_message');
                  echo "<p class='paragraph'>$error_message</p>";
                ?>
              </form>
            </div>
          </div>
        </div>
      </main>

    </div>
  </div>

</body>

</html>