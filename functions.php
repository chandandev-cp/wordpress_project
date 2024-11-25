<?php
function custom_css()
{
    wp_enqueue_style('bootstrap_css',get_template_directory_uri().'/assets/css/bootstrap.css',array(), 1.0, 'all');
    wp_enqueue_style('font-awesome_min_css', get_template_directory_uri(). '/assets/css/font-awesome.min.css', array(), 1.0 , 'all');
    wp_enqueue_style('nice_select_min_css',"https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" ,array(), 1.0, 'all');
    wp_enqueue_style('slick_min_css',"https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" ,array(), 1.0, 'all');
    wp_enqueue_style('slick-theme_min_css_map',"https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css.map" ,array(), 1.0, 'all');
    wp_enqueue_style('style_css', get_template_directory_uri(). '/assets/css/style.css', array(), 1.0 , 'all');
    wp_enqueue_style('responsive_css', get_template_directory_uri(). '/assets/css/responsive.css', array(), 1.0 , 'all');

}
add_action('wp_enqueue_scripts','custom_css');

function custom_js()
{
    wp_enqueue_script('jquery-3_4_1_min_js', get_template_directory_uri(). '/assets/js/jquery-3.4.1.min.js', array(), '', 'true');
    wp_enqueue_script('bootstrap_js', get_template_directory_uri(). '/assets/js/bootstrap.js', array(), '', 'true');
    wp_enqueue_script('slick_js',"https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.js", array(), '','true');
    wp_enqueue_script('slick_js',"https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js", array(), '','true');
    wp_enqueue_script('custom_js', get_template_directory_uri(). '/assets/js/custom.js', array(), '', 'true');
}  
add_action('wp_enqueue_scripts','custom_js');

//register nav menus

function register_my_menu() {
    register_nav_menus(array(
        'header-menu' => __('Primary Menu', 'theme-textdomain'),
        'footer-menu' => __('Secondary Menu', 'theme-textdomain'),
    ));
}
add_action('init', 'register_my_menu');

//Botstrap 5 navwalker
class bootstrap_5_wp_nav_menu_walker extends Walker_Nav_menu
{
  private $current_item;
  private $dropdown_menu_alignment_values = [
    'dropdown-menu-start',
    'dropdown-menu-end',
    'dropdown-menu-sm-start',
    'dropdown-menu-sm-end',
    'dropdown-menu-md-start',
    'dropdown-menu-md-end',
    'dropdown-menu-lg-start',
    'dropdown-menu-lg-end',
    'dropdown-menu-xl-start',
    'dropdown-menu-xl-end',
    'dropdown-menu-xxl-start',
    'dropdown-menu-xxl-end'
  ];

  function start_lvl(&$output, $depth = 0, $args = null)
  {
    $dropdown_menu_class[] = '';
    foreach($this->current_item->classes as $class) {
      if(in_array($class, $this->dropdown_menu_alignment_values)) {
        $dropdown_menu_class[] = $class;
      }
    }
    $indent = str_repeat("\t", $depth);
    $submenu = ($depth > 0) ? ' sub-menu' : '';
    $output .= "\n$indent<ul class=\"dropdown-menu$submenu " . esc_attr(implode(" ",$dropdown_menu_class)) . " depth_$depth\">\n";
  }

  function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
  {
    $this->current_item = $item;

    $indent = ($depth) ? str_repeat("\t", $depth) : '';

    $li_attributes = '';
    $class_names = $value = '';

    $classes = empty($item->classes) ? array() : (array) $item->classes;

    $classes[] = ($args->walker->has_children) ? 'dropdown' : '';
    $classes[] = 'nav-item';
    $classes[] = 'nav-item-' . $item->ID;
    if ($depth && $args->walker->has_children) {
      $classes[] = 'dropdown-menu dropdown-menu-end';
    }

    $class_names =  join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
    $class_names = ' class="' . esc_attr($class_names) . '"';

    $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
    $id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';

    $output .= $indent . '<li ' . $id . $value . $class_names . $li_attributes . '>';

    $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
    $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
    $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
    $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

    $active_class = ($item->current || $item->current_item_ancestor || in_array("current_page_parent", $item->classes, true) || in_array("current-post-ancestor", $item->classes, true)) ? 'active' : '';
    $nav_link_class = ( $depth > 0 ) ? 'dropdown-item ' : 'nav-link ';
    $attributes .= ( $args->walker->has_children ) ? ' class="'. $nav_link_class . $active_class . ' dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' : ' class="'. $nav_link_class . $active_class . '"';

    $item_output = $args->before;
    $item_output .= '<a' . $attributes . '>';
    $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
    $item_output .= '</a>';
    $item_output .= $args->after;

    $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
  }
}

//theme support
add_theme_support('post-thumbnails');

//register field in setting
add_filter('admin_init', 'register_fields');
function register_fields()
{
  register_setting('general', 'map', 'esc_attr');
    add_settings_field('map', '<label for="map">'
    .__('Map' , 'map' ).'</label>' , 'map', 'general');


   register_setting('general', 'phone', 'esc_attr');
    add_settings_field('phone', '<label for="phone">'
    .__('Phone' , 'phone' ).'</label>' , 'phone', 'general');

    register_setting('general', 'email', 'esc_attr');
    add_settings_field('email', '<label for="email">'
    .__('Email' , 'email' ).'</label>' , 'email', 'general');


    register_setting('general', 'facebook', 'esc_attr');
    add_settings_field('facebook', '<label for="facebook">'
    .__('Facebook' , 'facebook' ).'</label>' , 'facebook', 'general');
    
    register_setting('general', 'twitter', 'esc_attr');
    add_settings_field('twitter', '<label for="twitter">'
    .__('Twitter' , 'twitter' ).'</label>' , 'twitter', 'general');

    register_setting('general', 'linkedin', 'esc_attr');
    add_settings_field('linkedin', '<label for="linkedin">'
    .__('Linkedin' , 'linkedin' ).'</label>' , 'linkedin', 'general');
}

function map()
   {
       $value = get_option( 'map', '' );
       echo '<input type="text" id="map" name="map"
       class="regular-text" value="' . $value . '" />';
   }
function phone()
   {
       $value = get_option( 'phone', '' );
       echo '<input type="text" id="phone" name="phone"
       class="regular-text" value="' . $value . '" />';
   }

   function email()
   {
       $value = get_option( 'email', '' );
       echo '<input type="text" id="email" name="email"
       class="regular-text" value="' . $value . '" />';
   }  
   
   function facebook()
   {
       $value = get_option( 'facebook', '' );
       echo '<input type="text" id="facebook" name="facebook"
       class="regular-text" value="' . $value . '" />';
   }
   function twitter()
   {
       $value = get_option( 'twitter', '' );
       echo '<input type="text" id="twitter" name="twitter"
       class="regular-text" value="' . $value . '" />';
   }
   function linkedin()
   {
       $value = get_option( 'linkedin', '' );
       echo '<input type="text" id="linkedin" name="linkedin"
       class="regular-text" value="' . $value . '" />';
   }

   function receipes_types() {
    $labels = array(
        'name' => 'Receipe',
        'singular_name' => 'Receipe',
        'add_new' => 'Add New Receipe',
        'add_new_item' => 'Add New Receipe',
        'edit_item' => 'Edit Receipe',
        'new_item' => 'New Receipe',
        'all_items' => 'All Receipe',
        'view_item' => 'View Receipe',
        'search_items' => 'Search Receipe',
        'not_found' =>  'No Receipe Found',
        'not_found_in_trash' => 'No Receipe found in Trash',
        'parent_item_colon' => '',
        'menu_name' => 'Receipe',
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'Receipe'),
        'query_var' => true,
        'menu_icon' => 'dashicons-food',
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'trackbacks',
            'custom-fields',
            'comments',
            'revisions',
            'thumbnail',
            'author',
            'page-attributes'
        )
    );
    register_post_type( 'receipe', $args );
    // register taxonomy
    register_taxonomy('receipe_category', 'receipe',
        array(
                'hierarchical'  => true,
                'label'         => 'Category',
                'query_var'     => true,
                'rewrite'       => array(
                'slug'          => 'receipe-category'
            )
        )
    );
  }
  add_action( 'init', 'receipes_types' );
?>

