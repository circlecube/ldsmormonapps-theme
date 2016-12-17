<?php
/**
 * LDS Mormon Apps functions and definitions
 *
 * @package LDS Mormon Apps
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'ldsmormonapps_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function ldsmormonapps_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on LDS Mormon Apps, use a find and replace
	 * to change 'ldsmormonapps' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'ldsmormonapps', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'ldsmormonapps' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'ldsmormonapps_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // ldsmormonapps_setup
add_action( 'after_setup_theme', 'ldsmormonapps_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function ldsmormonapps_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'ldsmormonapps' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Home Page', 'ldsmormonapps' ),
		'id'            => 'home-aside',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Aside', 'ldsmormonapps' ),
		'id'            => 'footer-aside',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'ldsmormonapps_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function ldsmormonapps_scripts() {
	
	//modernizr
	wp_enqueue_script('modernizr', get_template_directory_uri() . '/js/vendor/modernizr.js', array(), '20150326', true);
	
	//foundation
	// wp_enqueue_style( 'normalize', get_template_directory_uri() . '/css/normalize.css' ); lready included in styles.css
	wp_enqueue_style( 'foundation-css', get_template_directory_uri() . '/css/foundation.css' );
	wp_enqueue_script('foundation-js', get_template_directory_uri() . '/js/foundation.min.js', array('jquery'), '20150326', true);
	
	wp_enqueue_style( 'flickity-css', get_template_directory_uri() . '/css/flickity.css' );
	wp_enqueue_script('flickity-js', get_template_directory_uri() . '/js/vendor/flickity.pkgd.min.js', array(), '20150410', true);

	wp_enqueue_script('isotope-js', get_template_directory_uri() . '/js/vendor/isotope.pkgd.min.js', array('jquery'), '20150506', true);
	
	wp_enqueue_style( 'ldsmormonapps-style', get_stylesheet_uri() );

	wp_enqueue_script( 'ldsmormonapps-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '20150410', true );

	wp_enqueue_script( 'ldsmormonapps-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ldsmormonapps_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';



//Add apps to rss feed - which is then sent out in a mailchimp newsletter
function myfeed_request($qv) {
	if (isset($qv['feed']) && !isset($qv['post_type']))
		$qv['post_type'] = array('post', 'app');
	return $qv;
}
add_filter('request', 'myfeed_request');


//Add thumbnails to RSS
function rss_post_thumbnail($content) {  
    
    if( is_feed() && get_post_type() == 'app' ) {
	    $short_desc = get_field('short_description');
    	// $output = '<media:content url="' . wp_get_attachment_url( get_post_thumbnail_id() ) . '" medium="image" isDefault="true" >';    
        $content = $short_desc;  
    }
    if( is_feed() && has_post_thumbnail($post->ID)) {
	    $thumnail_html = '<p>' . get_the_post_thumbnail($post->ID) . '</p>';
    	// $output = '<media:content url="' . wp_get_attachment_url( get_post_thumbnail_id() ) . '" medium="image" isDefault="true" >';    
        $content = $thumnail_html . $content;  
    }
    return $content;  
}  
add_filter('the_excerpt_rss', 'rss_post_thumbnail');
add_filter('the_content_feed', 'rss_post_thumbnail');


/* Add our function to the widgets_init hook. */
add_action( 'widgets_init', 'cc_load_widgets' );
/* Function that registers our widget. */
function cc_load_widgets() {
    register_widget( 'CC_Apps_Widget' );
}
//Register Recent Posts List Widget
class CC_Apps_Widget extends WP_Widget {   
    function CC_Apps_Widget() {
        /* Widget settings. */
        $widget_ops = array( 'classname' => 'apps_container', 'description' => 'List the apps.' );
        /* Widget control settings. */
        $control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'cc_apps_widget' );
        /* Create the widget. */
        $this->WP_Widget( 'cc_apps_widget', 'Apps List', $widget_ops, $control_ops );
    }
    function widget( $args, $instance ) {
        extract( $args );
        /* User-selected settings. */
        $title = apply_filters('widget_title', $instance['title'] );
        // $num = $instance['num'];
        
        // var_dump($args);
        /* Before widget (defined by themes). */
        echo $before_widget;
        /* Title of widget (before and after defined by themes). */
        if ( $title )
            echo $before_title . $title . $after_title;
        else
            echo $before_title . 'Mormon Apps' . $after_title;
        
        echo '<div class="show_widget_content">';
        $widget_apps = get_field('apps', "widget_" . $args["widget_id"]);
        // var_dump($widget_apps);
		if ( $widget_apps ){ 
			echo '<div class="apps-widget">';
		
			foreach ( $widget_apps as $app ) {
				// setup_postdata( $post );		
				
				//ignore this app, if I'm on the app page already, don't list it in the list
				if ( $app->ID != get_the_ID() ) {
             ?>
                <section class="row">
                	<article class="app">
                		<header>
                			<?php /* if (get_field('hero_image', $app->ID) ){ ?>
                			<div class="app-img">
                				<img class="app-hero" alt="<?php echo get_the_title($app->ID, $app->ID); ?>" src="<?php the_field('hero_image', $app->ID); ?>" />
                			</div>
                			<?php }//endif */ ?>
                		</header>
                		<a class="app-link row" href="<?php echo get_the_permalink($app->ID); ?>">
                			<?php if ( has_post_thumbnail($app->ID) ) { ?>
                			<div class="app-icon small-3 medium-3 large-3 columns">
                				<div class="app-thumbnail-mask"></div>
                					<img class="app-thumbnail" alt="<?php the_title($app->ID); ?>" src="<?php echo wp_get_attachment_url( get_post_thumbnail_id($app->ID) ); ?>" />
                			</div>
                			<?php } ?>
                			<div class="app-description small-9 medium-9 large-9 columns">
                				<h1><?php echo get_the_title($app->ID); ?></h1>
                				<?php the_field('short_description', $app->ID); ?>
                			</div>
                		</a>
                		<footer class="row">
                			<div class="app-links small-9 small-offset-3 medium-9 medium-offset-3 large-9 large-offset-3 columns">
                				<div class="row">
                				<?php if ( get_field('google_play_link', $app->ID) ) { ?>
                					<div class="small-12 medium-4 large-4 columns">
                						<a href="<?php the_field('google_play_link', $app->ID); ?>" class="applink android" 
										onclick="__gaTracker('send', 'event', 'outbound-appstore', '<?php the_field('google_play_link', $app->ID); ?>', '<?php echo get_the_title($app->ID); ?>');" 
										target="_blank"><?php echo get_the_title($app->ID); ?> Get Android app on Google Play</a>
                					</div>
                				<?php } ?>
                				<?php if ( get_field('itunes_store_link', $app->ID) ) { ?>
                					<div class="small-12 medium-4 large-4 columns">
                						<a href="<?php the_field('itunes_store_link', $app->ID); ?>" class="applink ios" 
										onclick="__gaTracker('send', 'event', 'outbound-appstore', '<?php the_field('itunes_store_link', $app->ID); ?>', '<?php echo get_the_title($app->ID); ?>');" 
										target="_blank"><?php echo get_the_title($app->ID); ?> Available on the iTunes App Store</a>
                					</div>
                				<?php } ?>
                				<?php if ( get_field('amazon_store_link', $app->ID) ) { ?>
                					<div class="small-12 medium-4 large-4 columns">
                						<a href="<?php the_field('amazon_store_link', $app->ID); ?>" class="applink amazon" 
										onclick="__gaTracker('send', 'event', 'outbound-appstore', '<?php the_field('amazon_store_link', $app->ID); ?>', '<?php echo get_the_title($app->ID); ?>');" 
										target="_blank"><?php echo get_the_title($app->ID); ?> Available in the Amazon Apps Store</a>
                					</div>
                				<?php } ?>
								<?php if ( get_field('windows_store_link', $app->ID) ) { ?>
									<div class="small-12 medium-4 columns end">
										<a href="<?php the_field('windows_store_link', $app->ID); ?>" class="applink windows" 
										onclick="__gaTracker('send', 'event', 'outbound-appstore', '<?php the_field('windows_store_link', $app->ID); ?>', '<?php echo get_the_title($app->ID); ?>');" 
										target="_blank"><?php echo get_the_title($app->ID); ?> Available in the Windows Store</a>
									</div>
								<?php } ?>
                				</div>
                			</div>
                		</footer>
                	</article>	
				</section>
        
            <?php }
            } //endwhile; 
				wp_reset_postdata(); 
            echo '</div>';
            ?>
        <?php } //endif; 
        echo '</div>';
        /* After widget (defined by themes). */
        echo $after_widget;
    }
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        /* Strip tags (if needed) and update the widget settings. */
        $instance['title'] = strip_tags( $new_instance['title'] );
        // $instance['num'] = strip_tags( $new_instance['num'] );
        return $instance;
    }
    function form( $instance ) {
        /* Set up some default widget settings. */
        $defaults = array( 'title' => 'Recent Posts', 'num' => '20' );
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
            <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
        </p>
        <!--<p>
            <label for="<?php echo $this->get_field_id( 'num' ); ?>">Number of Apps to list:</label>
            <input id="<?php echo $this->get_field_id( 'num' ); ?>" name="<?php echo $this->get_field_name( 'num' ); ?>" value="<?php echo $instance['num']; ?>" style="width:100%;" />
        </p>--><?php
    }
}
