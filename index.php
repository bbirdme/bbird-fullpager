<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?> 
	<?php wp_head(); ?>    
</head>

<body <?php body_class(); ?>>

<header class="site-header" >
    <nav>
     <a href="#" class="menu-trigger"><i class="fa fa-bars" aria-hidden="true"></i></a>
   <?php 
    wp_nav_menu( array(
    'menu_id' => 'menu', 
    'container' => '',
    'theme_location' => 'Primary',
    'fallback_cb' => false, 
    'walker' => new bbird_scroller_walker()   
) );
    
    ?>
    </nav>

</header><!-- .site-header -->

<div id="content" class="site-content">
<div id="fullpage">
    
<?php
// check if the repeater field has rows of data
if( have_rows('layout') ):
    
 $sectionID = 0; 
 	// loop through the rows of data
    while ( have_rows('layout') ) : the_row();
          $image1 = get_sub_field('image');
          if( !empty($image1) ): 
              $url = $image1['url'];
          endif;       
        
    $sectionID++;
       ?>
    <div id="section<?php echo $sectionID; ?>" class="section" style="background-image:url(<?php echo $url; ?>) ">
       <h1><?php the_sub_field('anchor'); ?></h1>
        <?php
           // display a sub field value
        the_sub_field('text');        
      
echo '</div>';
    endwhile;

else :
    // no rows found
endif;
?>

</div> <!-- section -->
</div><!-- .site-content -->

<?php wp_footer(); ?>
</body>
</html>