<?php
/*
Plugin Name: WP Responsive FAQ with Category
Plugin URL: http://wponlinehelp.com
Description: A simple FAQ plugin created with WordPress custom post type.
Text Domain: jd-faq
Domain Path: /languages/
Version: 2.1
Author: WP Online Help
Author URI: http://wponlinehelp.com
Contributors: WP Online Help
*/

if( !defined( 'JD_FAQ_VERSION' ) ) {
	define( 'JD_FAQ_VERSION', '2.1' ); // Version of plugin
}

if( !defined( 'JD_FAQ_DIR' ) ) {
	define( 'JD_FAQ_DIR', dirname( __FILE__ ) ); // Plugin dir
}

if( !defined( 'JD_FAQ_POST_TYPE' ) ) {
	define( 'JD_FAQ_POST_TYPE', 'jd_faq' ); // Plugin post type
}




add_action('plugins_loaded', 'jd_faq_load_textdomain');
function jd_faq_load_textdomain() {
	load_plugin_textdomain( 'jd-faq', false, dirname( plugin_basename(__FILE__) ) . '/languages/' );
} 

 
function jd_faq_setup_post_types() {
	$faq_labels =  apply_filters( 'jd_faq_labels', array(
		'name'                 => _x('FAQs', 'jd-faq'),
		'singular_name'        => _x('FAQ', 'jd-faq'),
		'add_new'              => _x('Add New', 'jd-faq'),
		'add_new_item'        => __('Add New FAQ', 'jd-faq'),
		'edit_item'           => __('Edit FAQ', 'jd-faq'),
		'new_item'            => __('New FAQ', 'jd-faq'),
		'all_items'           => __('All FAQ', 'jd-faq'),
		'view_item'           => __('View FAQ', 'jd-faq'),
		'search_items'        => __('Search FAQ', 'jd-faq'),
		'not_found'           => __('No FAQ found', 'jd-faq'),
		'not_found_in_trash'  => __('No FAQ found in Trash', 'jd-faq'),
		'parent_item_colon'   => '',
		'menu_name'           => __('FAQ', 'jd-faq'),
		'exclude_from_search' => true
	) );
	$faq_args = array(
		'labels' 			=> $faq_labels,
		'public' 			=> true,
		'publicly_queryable'=> true,
		'show_ui' 			=> true,
		'show_in_menu' 		=> true,
		'query_var' 		=> true,
		'capability_type' 	=> 'post',
		'has_archive' 		=> true,
		'hierarchical' 		=> false,
		'menu_icon'   => 'dashicons-plus-alt',
		'supports' => array('title','editor','thumbnail','excerpt')
	);
	register_post_type( 'jd_faq', apply_filters( 'jd_faq_post_type_args', $faq_args ) );
}
add_action('init', 'jd_faq_setup_post_types');
/*
 * Add [jd_faq limit="-1"] shortcode
 *
 */
function jd_faq_shortcode( $atts, $content = null ) {
	extract(shortcode_atts(array(
		"limit" => '',
		"category" => '',
		"single_open"   => '',
		"transition_speed" => '',
	), $atts));
	// Define limit
	if( $limit ) { 
		$posts_per_page = $limit; 
	} else {
		$posts_per_page = '-1';
	}
	// Define limit
	if( $category ) { 
		$cat = $category; 
	} else {
		$cat = '';
	}
	
	if( $single_open != ''  ) { 
		$faqsingleOpen = $single_open; 
	} else {
		$faqsingleOpen = 'true';
	}
	
	if( $transition_speed != '' ) { 
		$faqtransitionSpeed = $transition_speed; 
	} else {
		$faqtransitionSpeed = '300';
	}
	
	ob_start();
	// Create the Query
	
	$post_type 		= 'jd_faq';
	$orderby 		= 'post_date';
	$order 			= 'DESC';
				 
        $args = array ( 
            'post_type'      => $post_type, 
            'orderby'        => $orderby, 
            'order'          => $order,
            'posts_per_page' => $posts_per_page,           
            );
	if($cat != ""){
            	$args['tax_query'] = array( array( 'taxonomy' => 'jd_faq_cat', 'field' => 'term_id', 'terms' => $cat) );
            }        
      $query = new WP_Query($args);
	//Get post type count
	$post_count = $query->post_count;
	$i = 1;
	// Displays Custom post info
	if( $post_count > 0) :
	?>
	<div class="jd-faq-accordion" data-accordion-group>	
	
	<?php while ($query->have_posts()) : $query->the_post();
		?>			  
      <div data-accordion class="jd-faq-main">
        <div data-control class="jd-faq-title"><h4> <?php the_title(); ?></h4></div>
        <div data-content>
         <?php
                  if ( function_exists('has_post_thumbnail') && has_post_thumbnail() ) { 
				  
                    the_post_thumbnail('thumbnail'); 
                  }
                  ?>
				  
          
        <div class="jd-faq-content"><?php the_content(); ?></div>
      
        </div>
      </div>
	  
		<?php
		$i++;
		endwhile; ?>
		</div>
<?php	endif;
	// Reset query to prevent conflicts
	wp_reset_query();
	?>
	    <script type="text/javascript">
      jQuery(document).ready(function() {
        jQuery('.jd-faq-accordion [data-accordion]').accordionfaq({
		 singleOpen: <?php echo $faqsingleOpen; ?>,
		 transitionEasing: 'ease',
          transitionSpeed: <?php echo $faqtransitionSpeed; ?>
		});        
      });
    </script>
	<?php
	return ob_get_clean();
}
add_shortcode("wpoh_faq", "jd_faq_shortcode");

/* Register Taxonomy */
add_action( 'init', 'free_jd_faq_taxonomies');
function free_jd_faq_taxonomies() {
    $labels = array(
        'name'              => _x( 'Category', 'jd-faq' ),
        'singular_name'     => _x( 'Category', 'jd-faq' ),
        'search_items'      => __( 'Search Category', 'jd-faq' ),
        'all_items'         => __( 'All Category', 'jd-faq' ),
        'parent_item'       => __( 'Parent Category', 'jd-faq' ),
        'parent_item_colon' => __( 'Parent Category' , 'jd-faq' ),
        'edit_item'         => __( 'Edit Category', 'jd-faq' ),
        'update_item'       => __( 'Update Category', 'jd-faq' ),
        'add_new_item'      => __( 'Add New Category', 'jd-faq' ),
        'new_item_name'     => __( 'New Category Name', 'jd-faq' ),
        'menu_name'         => __( 'FAQ Category', 'jd-faq' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'jd_faq_cat' ),
    );

    register_taxonomy( 'jd_faq_cat', array( 'jd_faq' ), $args );
}

add_action( 'wp_enqueue_scripts','jd_css_script_free' );
function jd_css_script_free() {
    wp_enqueue_style( 'jdaccordioncss',  plugin_dir_url( __FILE__ ). 'css/wpoh-public-faq.css', array(), JD_FAQ_VERSION );
    wp_enqueue_script( 'jdaccordionjs', plugin_dir_url( __FILE__ ) . 'js/wpoh-public-faq.js', array( 'jquery' ), JD_FAQ_VERSION );
}

// Manage Category Shortcode Columns
add_filter("manage_jd_faq_cat_custom_column", 'free_jd_faq_cat_columns', 10, 3);
add_filter("manage_edit-jd_faq_cat_columns", 'free_jd_faq_cat_manage_columns'); 
 
function free_jd_faq_cat_manage_columns($theme_columns) {
    $new_columns = array(
            'cb' => '<input type="checkbox" />',
            'name' => __('Name'),
            'jd_faq_category_shortcode' => __( 'FAQ Category Shortcode', 'jd-faq' ),
            'slug' => __('Slug'),
            'posts' => __('Posts')
        );
    return $new_columns;

}


function free_jd_faq_cat_columns($out, $column_name, $theme_id) {
    $theme = get_term($theme_id, 'jd_faq_cat');
    switch ($column_name) {
        
        case 'title':
            echo get_the_title();
        break;

        case 'jd_faq_category_shortcode':             
             echo '[wpoh_faq category="' . $theme_id. '"]';
        break;
 
        default:
            break;
    }
    return $out;    
}

