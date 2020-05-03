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
					<h1 class="overview__heading">Available Hotels</h1>
				</div>

				<!-- List of Hotels -->
				<?php
					foreach ($hotels as $hotel) {
						$id = $hotel['id'];
						$name = $hotel['name'];
						$location = $hotel['location'];
						$headline = $hotel['headline'];
						$picture = base_url() . $hotel['picture'];
						$rating = $hotel['rating'];
						$star = $hotel['star'];
						$stars = '';

						$str =  
						"
							<div class='detail'>
								<div class='description'>

									<div class='hotel-card'>							
										<p class='hotel-card__name'>$name</p>
											<svg class='overview__icon-location'>
													<use xlink:href='" . base_url() . "/assets/images/svg/sprite.svg#icon-location-pin'></use>
											</svg>
												<button class='btn-inline'>$location</button>
												<p class='hotel-card__rating'>($rating)</p>

											<p class='paragraph u-margin-top'>$headline</p>

											<div class='overview__stars u-margin-top'>
						";

							for($i = 0; $i < $star; $i++) {
								$stars .= "
									<svg class='overview__icon-star'>
										<use xlink:href='" . base_url() . "/assets/images/svg/sprite.svg#icon-star'></use>
									</svg>
								";
							}

						$endString = "
										</div>
										<a href='booking/showDetail/$id' class='btn-inline u-margin-top'>See more!</a>
									</div>	
								</div>	
							
								<div class='user-reviews'>
									<img src='$picture' class='user-reviews--hotel-photo'>
								</div>
							</div>
						";		
						
						echo $str . $stars . $endString;

						}
					?>
					
			</main>

		</div>
	</div>

<!--
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
			foreach ($hotels as $hotel) {
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
	foreach ($histories as $history) {
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
	<form action="<?php echo site_url() . "/dashboard/search"; ?>" , method="POST">
		<input type="text" name="search">
		<input type="submit" value="Search">
	</form>
-->
</body>

</html>