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
        <div class="overview">
          <h1 class="overview__heading">Confirm Booking</h1>
        </div>
        <div class="detail">
          <div class="description--profile">
            <h2 class="user-order__figure__subheading">Your orders:</h2>
            <?php
              $id = $this->session->userdata('hotel_id');
              $hotel_name = $this->session->userdata('hotel_name');
              $num_rooms = $this->session->userdata('num_rooms');
              $duration = $this->session->userdata('duration');
              $room = $this->session->userdata('room_name');
              $price = number_format($this->session->userdata('payment_price'));
              $check_in = $this->session->userdata('date_check_in');
              $check_out = $this->session->userdata('date_check_out');
            ?>
            <div class="booking-table">
              <table>
                <tr>
                  <th>Username</th>
                  <td><?= $this->session->userdata('username'); ?></td>
                </tr
                <tr>
                  <th>Full Name</th>
                  <td><?= $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name'); ?></td>
                </tr>
                <tr>
                  <th>Hotel Name</th>
                  <td><?= $hotel_name; ?></td>
                </tr>
                <tr>
                  <th>Number of Rooms</th>
                  <td><?= $num_rooms; ?></td>
                </tr>
                <tr>
                  <th>Check In Date</th>
                  <td><?= $check_in; ?></td>
                </tr>
                <tr>
                  <th>Check Out Date</th>
                  <td><?= $check_out; ?></td>
                </tr>
                <tr>
                  <th>Duration</th>
                  <td><?= $duration; ?> night(s)</td>
                </tr>
                <tr>
                  <th>Room ID</th>
                  <td><?= $room_id; ?></td>
                </tr>
                <tr>
                  <th>Room Type</th>
                  <td><?= $room; ?></td>
                </tr>
                <tr>
                  <th>Total Price</th>
                  <td>Rp. <?= $price; ?></td>
                </tr>
              </table>  
              <ul class="list">
                <p class="paragraph">Terms and Conditions:</p>
                <li class='list__item--oneline'>Once paid, you cannot ask for a refund!</li>
                <li class="list__item--oneline">If you are unsatisfied with your stay, please contact your hotel.</li>
                <li class="list__item--oneline">If you have any questions, please don't hesitate to contact us.</li>
                <li class="list__item--oneline">We provide a guarantee for good hotels.</li>
                <li class="list__item--oneline">You can pay by using vouchers at the Profile section.</li>
                <li class="list__item--oneline">You are agreeing to our terms and conditions if you use our services.</li>
              </ul>
            </div>
            <div class="u-center-text">
              <p class="paragraph">We hope you enjoy our services! Please click the link below to reserve your room!</p>
              <a class="btn-inline u-center-text" href="<?= site_url() . "booking/orderHotel"; ?>">Reserve Your Hotel Now!</a>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
</body>
</html>