<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Intractive &mdash; Your Dashboard!</title>
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
					<a href="<?= site_url() . "search/sortByRating/ascending"; ?>">Sort by Rating (Asc) &nbsp;&nbsp;&nbsp;</a>
					<a href="<?= site_url() . "search/sortByRating/descending"; ?>">Sort by Rating (Desc) &nbsp;&nbsp;&nbsp;</a>
					<a href="<?= site_url() . "search/filterByStar"; ?>">Filter Star (5)</a>
					
					<!--
					<form action="<?php echo site_url() . "search/filterPrice"; ?>" class="search" name="search_form" method="GET">
						<input type="text" class="search__input" name="q" autocomplete="off" placeholder="Filter your own price...">
						<button class="search__button">
							<svg class="search__icon">
								<use xlink:href="<?php echo base_url() . "/assets/images/svg/sprite.svg#icon-magnifying-glass"; ?>"></use>
							</svg>
						</button>
					</form>
					-->
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
					$link_to_hotel = site_url() . "booking/showDetail/$id";
				?>
					<div class='detail'>
						<div class='description'>
							<div class='hotel-card'>
								<p class='hotel-card__name'><?= $name; ?></p>
								<svg class='overview__icon-location'>
									<use xlink:href="<?= base_url() . "/assets/images/svg/sprite.svg#icon-location-pin" ?>"></use>
								</svg>
								<button class='btn-inline'><?= $location; ?></button>
								<p class='hotel-card__rating'>(<?= $rating; ?> of 10)</p>
								<p class='paragraph u-margin-top'><?= $headline; ?></p>
								<div class='overview__stars u-margin-top'>
									<?php
									for ($i = 0; $i < $star; $i++) {
									?>
										<svg class='overview__icon-star'>
											<use xlink:href="<?= base_url() . "/assets/images/svg/sprite.svg#icon-star" ?>"></use>
										</svg>
									<?php
									}
									?>
								</div>
								<a href="<?= $link_to_hotel; ?>" class='btn-inline u-margin-top'>See more!</a>
							</div>
						</div>
						<div class='user-reviews'>
							<img src="<?= $picture; ?>" class='user-reviews--hotel-photo'>
						</div>
					</div>
				<?php
				}
				?>
			</main>
		</div>
	</div>
</body>

</html>