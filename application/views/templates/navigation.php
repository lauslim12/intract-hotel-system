<header class="header">
  <a href="<?php echo site_url(); ?>">
    <img src="<?php echo base_url() . "/assets/images/icons/logo.png"; ?>" alt="Trillo logo" class="logo">
  </a>

  <form action="search.php" class="search" name="search_form">
    <input type="text" class="search__input" name="q" autocomplete="off" placeholder="Search hotels...">
    <button class="search__button">
      <svg class="search__icon">
        <use xlink:href="<?php echo base_url() . "/assets/images/svg/sprite.svg#icon-magnifying-glass"; ?>"></use>
      </svg>
    </button>
  </form>

  <nav class="user-nav">
    <div class="user-nav__icon-box">
      <a href='https://github.com/lauslim12/intract-social-network'>
        <svg class="user-nav__icon">
          <use xlink:href="<?php echo base_url() . "/assets/images/svg/sprite.svg#icon-github"; ?>"></use>
        </svg>
      </a>
    </div>

    <div class="user-nav__icon-box">
      <svg class="user-nav__icon">
        <use xlink:href="<?php echo base_url() . "/assets/images/svg/sprite.svg#icon-bookmark"; ?>"></use>
      </svg>
      <span class="user-nav__notification">5</span>
    </div>

    <div class="user-nav__icon-box">
      <svg class="user-nav__icon">
        <use xlink:href="<?php echo base_url() . "/assets/images/svg/sprite.svg#icon-chat"; ?>"></use>
      </svg>
      <span class="user-nav__notification">10</span>
    </div>

    <div class="user-nav__user">
      <img src="<?php echo base_url() . $this->session->userdata('profile_pic'); ?>" alt="User photo" class="user-nav__user-photo">
      <span class="user-nav__user-name"><a href="<?php echo site_url() . 'profile/view/' . $this->session->userdata('username'); ?>"><?php echo $this->session->userdata('username'); ?></a></span>
    </div>

    <div class="user-nav__icon-box">
      <a href="<?php echo site_url() . "/dashboard/logout"; ?>">
        <svg class="user-nav__icon">
          <use xlink:href="<?php echo base_url() . "/assets/images/svg/sprite.svg#icon-key"; ?>"></use>
        </svg>
      </a>
    </div>
  </nav>
</header>