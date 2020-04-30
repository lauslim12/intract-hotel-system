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
							<td>booking disini</td>
						</tr>
					";

				}
			?>
		</tbody>

	</table>


</body>
</html>