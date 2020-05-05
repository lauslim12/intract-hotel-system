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
  
        <div class="overview">
          <h1 class="overview__heading">Confirm Booking</h1>        
        </div>
        
        <div class="detail">
          <div class="description">      
          <h2 class="user-order__figure__subheading">Your orders:</h2>
            <?php
              $id = $this->session->userdata('hotel_id');
              $hotel_name = $this->session->userdata('hotel_name');
              $num_rooms = $this->session->userdata('num_rooms');
              $duration = $this->session->userdata('duration');
              $room = $this->session->userdata('room_name');

              echo "
                <p class='paragraph'>Hotel name: $hotel_name</p>
                <p class='paragraph'>Total price: $payment_price</p>
                <p class='paragraph'>Number of rooms: $num_rooms</p>
                <p class='paragraph'>Duration: $duration</p>
                <p class='paragraph'>Room name: $room</p>
              ";
            ?>
            <a href="<?php echo site_url() . "/booking/orderHotel"; ?>">Order!</a>

          </div>
        </div>
			</main>
		</div>

  </div>
</body>

</html>