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
	<h1>ini quick prototyping jadi maaf bahasanya jelek</h1>
	<p>masuk</p>
	<p>selamat datang</p>
	<a href="<?php echo site_url() . "/dashboard/logout"; ?>">logout disini</a>

	<p>list hotel</p>
	<table>
		<thead>
			<th>nama</th>
			<th>lokasi</th>
			<th>deskripsi</th>
			<th>jumlah kamar</th>
			<th>rating</th>
			<th>harga</th>
			<th>aksi</th>
		</thead>
		<tbody>
			<?php 
				foreach($hotels as $hotel) {
					$id = $hotel['id'];
					$name = $hotel['name'];
          $location = $hotel['location'];
          $desc = $hotel['description'];
          $rooms = $hotel['rooms'];
					$rating = $hotel['rating'];
					$harga = $hotel['price'];

					echo "
						<tr>
							<td>$name</td>
							<td>$location</td>
							<td>$desc</td>
							<td>$rooms</td>
							<td>$rating</td>
							<td>$harga</td>
							<td><a href='booking/showBooking/$id'>booking disini</a></td>
						</tr>
					";

				}
			?>
		</tbody>

	</table>

	<hr>
	<h1>historyku</h1>
	<?php
		foreach($histories as $history) {
			$nomor = $history['id'];
			$hotel_name = $history['name'];
			$number_rooms = $history['num_rooms'];
			$price = $history['price'];

			echo "
				nomor: $nomor	
				nama: $hotel_name
				berapa kamar: $number_rooms
				harga yang dibayar: $price
				<hr>
			";
		}
	?>

	<h1>cari hotel</h1>
	<form action="<?php echo site_url() . "/dashboard/search"; ?>", method="POST">
		<input type="text" name="search">
		<input type="submit" value="Search">
	</form>

</body>
</html>