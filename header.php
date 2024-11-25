<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title><?php  bloginfo('name');
            wp_title();?></title>
  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700&display=swap" rel="stylesheet">

  <?php wp_head();?>

</head>

<body>

  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container">
          <a class="navbar-brand" href="<?php echo home_url();?>">
            <span>
              <?php bloginfo('name');
            wp_title();?>
            </span>
          </a>
          <div class="" id="">
            <div class="User_option">
              <a href="">
                <i class="fa fa-user" aria-hidden="true"></i>
                <span>Login</span>
              </a>
              <form class="form-inline ">
                <input type="search" placeholder="Search" />
                <button class="btn  nav_search-btn" type="submit">
                  <i class="fa fa-search" aria-hidden="true"></i>
                </button>
              </form>
            </div>
            <div class="custom_menu-btn">
              <button onclick="openNav()">
                <img src="<?php echo bloginfo('template_url');?>/assets/images/menu.png" alt="">
              </button>
            </div>
            <div id="myNav" class="overlay">
              <div class="overlay-content">
              <?php
                wp_nav_menu(array(
                    'theme_location' => 'header-menu', // Menu location
                    'container' => 'nav', // HTML container
                    'menu_class' => 'header-menu', // CSS class for styling
                ));
                ?>

              </div>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->