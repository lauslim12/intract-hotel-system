<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to Intractive!</title>
</head>
<body>
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

</body>
</html>