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
					<h1 class="overview__heading">Available Hotels</h1>
					<a href="<?php echo site_url() . "search/sortByRating/ascending"; ?>">Sort by Rating (Asc) &nbsp;&nbsp;&nbsp;</a>
					<a href="<?php echo site_url() . "search/sortByRating/descending"; ?>">Sort by Rating (Desc) &nbsp;&nbsp;&nbsp;</a>
					<a href="<?php echo site_url() . "search/filterByStar"; ?>">Filter Star (5)</a>
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
					$link_to_hotel = site_url() . "booking/showDetail/$id";

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

					for ($i = 0; $i < $star; $i++) {
						$stars .= "
									<svg class='overview__icon-star'>
										<use xlink:href='" . base_url() . "/assets/images/svg/sprite.svg#icon-star'></use>
									</svg>
								";
					}

					$endString = "
										</div>
										<a href='$link_to_hotel' class='btn-inline u-margin-top'>See more!</a>
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
</body>

</html>