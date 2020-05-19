<nav class="sidebar">
  <ul class="side-nav">

    <?php
      // Change this after hosting.
      if(!strpos($_SERVER['REQUEST_URI'], "search") && !strpos($_SERVER['REQUEST_URI'], "profile/view/")) {
        echo '<li class="side-nav__item side-nav__item--active">';
      }
      else {
        echo '<li class="side-nav__item side-nav__item">';
      }
    ?>
      <a href="<?php echo site_url(); ?>" class="side-nav__link">
        <svg class="side-nav__icon">
          <use xlink:href="<?php echo base_url() . "/assets/images/svg/sprite.svg#icon-home"; ?>"></use>
        </svg>
        <span>Hotels</span>
      </a>
    </li>

    <?php
      if(strpos($_SERVER['REQUEST_URI'], 'profile/view/')) {
        echo '<li class="side-nav__item side-nav__item--active">';
      }
      else {
        echo '<li class="side-nav__item side-nav__item">';
      }
    ?>
      <a href="<?php echo site_url() . "profile/view/" . $this->session->userdata('username'); ?>" class="side-nav__link">
        <svg class="side-nav__icon">
          <use xlink:href="<?php echo base_url() . "/assets/images/svg/sprite.svg#icon-aircraft-take-off"; ?>"></use>
        </svg>
        <span>Profile</span>
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
          <use xlink:href="<?php echo base_url() . "/assets/images/svg/sprite.svg#icon-magnifying-glass"; ?>"></use>
        </svg>
        <span>Search Results</span>
      </a>
    </li>

    <?php
      if($this->session->userdata('privilege_level') == 1) {
        echo '<li class="side-nav__item side-nav__item">';
    ?>
      <a href="<?php echo site_url() . "admin"; ?> " class="side-nav__link side-nav__link--results">
        <svg class="side-nav__icon">
          <use xlink:href="<?php echo base_url() . "/assets/images/svg/sprite.svg#icon-star"; ?>"></use>
        </svg>
        <span>Admin Panel</span>
      </a>
    </li>
    <?php
      }
    ?>
    

  </ul>

  <div class="legal">
    &copy; 2020 by Intractive, and Trillo. All Rights Reserved.
  </div>
</nav>

<!-- Shame. Remove later. It should be in intractive.js. -->
<script>
  document.querySelector('.side-nav__link--results').addEventListener('click', function() {
    alert('Please search in the search box before accessing this page!');
  });
</script>