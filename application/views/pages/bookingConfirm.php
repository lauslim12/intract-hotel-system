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
			<main class="hotel-view">
  
        <div class="overview">
          <h1 class="overview__heading">Confirm Booking</h1>        
        </div>
        
        <div class="detail">
          <div class="description">      
          <h2 class="user-order__figure__subheading">Your orders:</h2>
            <?php 
              $id = $user_orders['id'];
              $hotel_name = $user_orders['hotel_name'];
              $num_rooms = $user_orders['num_rooms'];
              $duration = $user_orders['duration'];
              $room = $user_orders['room'];

              $room_id = $room_id;

              echo "
                <form action='" . site_url() . "/booking/orderHotel" . "' method='POST'>
                  <input type='hidden' name='hotel_id' value='$id' readonly>
                  <input type='hidden' name='room_id' value='$room_id' readonly>
                  <input type='text' name='hotel_name' value='$hotel_name' readonly>
                  <input type='number' name='num_rooms' value='$num_rooms' required readonly>
                  <input type='number' name='duration' value='$duration' required readonly>
                  <input type='text' name='room_name' value='$room' required readonly>
                  <input type='number' name='price' value='$payment_price' required readonly>
                  <input type='submit' value='Order!'>
                </form>
              ";
            ?>
          </div>
        </div>
			</main>
		</div>

  </div>
</body>

</html>