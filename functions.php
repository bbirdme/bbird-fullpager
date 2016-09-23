<?php
// Some queueing, nothing serious here... 
// Created by Bruno Kos from bbird.mes

add_action('wp_enqueue_scripts', 'bbird_scroller_scripts');

function bbird_scroller_scripts() {
    wp_enqueue_style( 'basic-css', get_stylesheet_uri() );
    wp_enqueue_style( 'font-awseome', get_stylesheet_directory_uri().'/css/font-awesome.min.css' );
    wp_enqueue_style( 'fullpage-css', get_stylesheet_directory_uri() . '/css/jquery.fullPage.css');
    wp_enqueue_script('fullpage-js', get_stylesheet_directory_uri() . '/js/jquery.fullPage.js', array('jquery'));
    wp_enqueue_script('fullpage-initialize', get_stylesheet_directory_uri() . '/js/fullpage.initialize.js', array('jquery'));
}

// Register Navigation Menus
function bbird_scroller_register_menus() {

	$locations = array(
		'Primary' => __( 'Main and only menu in the theme', 'text_domain' ),
	);
	register_nav_menus( $locations );

}
add_action( 'init', 'bbird_scroller_register_menus' );

function increment()
{
    static $i = 1;
    return $i++;
}

class bbird_scroller_walker extends Walker_Nav_Menu {

     function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
 
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
 
        $args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
        $slider_value = 'slide' . increment();
        $output .= $indent . '<li data-menuanchor=' . $slider_value . $id . $class_names .'>';
 
        $atts = array();
        $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
        $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
        $atts['href']   = ! empty( $item->url )        ? $item->url        : '';
 
        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );
 
        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $title = apply_filters( 'the_title', $item->title, $item->ID );

        $title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );
        
        $item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . $title . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}