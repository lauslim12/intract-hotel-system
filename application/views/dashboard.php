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
					<h1 class="overview__heading">
						<?php
							if($this->session->flashdata('filterMessage') == "") {
								echo "Available Hotels";
							}
							else {
								echo $this->session->flashdata('filterMessage');
							}
						?>
					</h1>
					<div class="overview__filters">
						<div class="dropdown">					
							<h1 class="overview__heading">Filters</h1>
							<div class="dropdown__content">
								<ul class="dropdown__content__list">
								<form action="<?php echo site_url() . "search/filterPrice"; ?>" class="search" name="search_form" method="GET">
										<input type="text" class="search__input" name="q" autocomplete="off" placeholder="Fill your own budget!">
										<button class="search__button">
											<svg class="search__icon">
												<use xlink:href="<?php echo base_url() . "/assets/images/svg/sprite.svg#icon-magnifying-glass"; ?>"></use>
											</svg>
										</button>
									</form>
									<li class="dropdown__content__list__item u-margin-top">
										<a href="<?= site_url() . "search/sortByRating/ascending"; ?>">Sort by Rating (Asc)</a>
									</li>
									<li class="dropdown__content__list__item">
										<a href="<?= site_url() . "search/sortByRating/descending"; ?>">Sort by Rating (Dsc)</a>
									</li>
									<li class="dropdown__content__list__item">
										<a href="<?= site_url() . "search/filterByStar"; ?>">Filter Star (5)</a>
									</li>
									<li class="dropdown__content__list__item">
										<a href="<?= site_url() . "search/filterByStar"; ?>">Filter Star (4)</a>
									</li>
									<li class="dropdown__content__list__item">
										<a href="<?= site_url() . "search/filterByStar"; ?>">Filter Star (3)</a>
									</li>
									<li class="dropdown__content__list__item">
										<a href="<?= site_url() . "search/filterByStar"; ?>">Filter Star (2)</a>
									</li>
									<li class="dropdown__content__list__item">
										<a href="<?= site_url() . "search/filterByStar"; ?>">Filter Star (1)</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<!-- List of Hotels -->
				<?php
				/*  Combine joined arrays by its primary keys / foreign keys.
        *   The length of the array should be same, as it's a simple logic - one cannot have more rooms that one had ordered.
        *   Algorithm: Knapsack. Can't believe I have to use this in web development.
				*/
				for($i = 0; $i < count($hotels); $i++) {
					$id = $hotels[$i]['id'];
					$name = $hotels[$i]['name'];
					$location = $hotels[$i]['location'];
					$headline = $hotels[$i]['headline'];
					$picture = base_url() . $hotels[$i]['picture'];
					$rating = $hotels[$i]['rating'];
					$star = $hotels[$i]['star'];
					$link_to_hotel = site_url() . "booking/showDetail/$id";

					if(!empty($prices)) {
						$lowest_price_range = number_format($prices[$i]['min']);
						$highest_price_range = number_format($prices[$i]['max']);
					}
					else {
						$lowest_price_range = number_format($hotels[$i]['min']);
						$highest_price_range = number_format($hotels[$i]['max']);
					}
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
									for ($k = 0; $k < $star; $k++) {
									?>
										<svg class='overview__icon-star'>
											<use xlink:href="<?= base_url() . "/assets/images/svg/sprite.svg#icon-star" ?>"></use>
										</svg>
									<?php
									}
									?>
								</div>
								<a href="<?= $link_to_hotel; ?>" class='btn-inline u-margin-top'>See more!</a>
								<p class="paragraph u-margin-top">Prices start from Rp. <?= $lowest_price_range; ?> to Rp. <?= $highest_price_range; ?>!</p>
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