<nav class="sidebar">
  <ul class="side-nav">

    <?php
      // Change this after hosting.
      if(!strpos($_SERVER['REQUEST_URI'], "search") && !strpos($_SERVER['REQUEST_URI'], $user_logged_in)) {
        echo '<li class="side-nav__item side-nav__item--active">';
      }
      else {
        echo '<li class="side-nav__item side-nav__item">';
      }
    ?>
      <a href="index.php" class="side-nav__link">
        <svg class="side-nav__icon">
          <use xlink:href="assets/images/svg/sprite.svg#icon-home"></use>
        </svg>
        <span>Hotel</span>
      </a>
    </li>

    <?php
      if(strpos($_SERVER['REQUEST_URI'], $user_logged_in)) {
        echo '<li class="side-nav__item side-nav__item--active">';
      }
      else {
        echo '<li class="side-nav__item side-nav__item">';
      }
    ?>
      <a href="<?php echo $user_logged_in; ?>" class="side-nav__link">
        <svg class="side-nav__icon">
          <use xlink:href="assets/images/svg/sprite.svg#icon-aircraft-take-off"></use>
        </svg>
        <span>My Profile</span>
      </a>
    </li>

    <?php
      if(strpos($_SERVER['REQUEST_URI'], 'search')) {
        echo '<li class="side-nav__item side-nav__item--active">';
      }
      else {
        echo '<li class="side-nav__item side-nav__item">';
      }
    ?>
      <a href="#" class="side-nav__link side-nav__link--results">
        <svg class="side-nav__icon">
          <use xlink:href="assets/images/svg/sprite.svg#icon-magnifying-glass"></use>
        </svg>
        <span>Search Results</span>
      </a>
    </li>

  </ul>

  <div class="legal">
    &copy; 2020 by Intract, Bordeaux, Trillo. All Rights Reserved.
  </div>
</nav>