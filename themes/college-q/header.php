<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package College_Q
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/assets/bootstrap/css/bootstrap.min.css" />
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
      integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Aleo&amp;display=swap"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Roboto&amp;display=swap"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700&amp;display=swap"
    />

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'college-q' ); ?></a>

	<header>
      <div class="row">
		  <?php
		  wp_nav_menu( array(
			  'theme_location' => 'primary',
			  'container' => 'nav-list',
			  'container_class' => 'col nav',
			  'menu-class' => 'nav-list'
		  ));
		  ?>
        <div class="col nav">
          <ul class="nav-list">
            <li href="#"><i class="fas fa-info"></i>ABOUT</li>
            <li href="#"><i class="far fa-address-book"></i>CONTACT</li>
            <li href="#"><i class="fas fa-question-circle"></i>FAQ</li>
            <li href="#"><i class="fas fa-link"></i>LINKS</li>
            <li href="#"><i class="fab fa-blogger-b"></i>BLOG</li>
            <li href="#"><i class="fas fa-newspaper"></i>NEWS</li>
            <li href="#"><i class="fas fa-lightbulb"></i>RESOURCES</li>
          </ul>
        </div>
        <div class="col"></div>
        <div class="col sign-in my-auto">
          <div class="usr-icon">
            <i class="fas fa-user fa-9x"></i>
          </div>
          <div class="sign-in-btn">
            <button class="btn btn-primary w-100" type="submit">
              Sign In
            </button>
          </div>
          
        </div>
      </div>
    </header>
	