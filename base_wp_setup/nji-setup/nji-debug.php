<?php
//
// this file should only be included if NJIMEDIA_DEBUG == TRUE.
//
add_action( 'wp_enqueue_scripts', 'njimedia_debug_enqueue_style' );
add_action( 'wp_enqueue_scripts', 'njimedia_debug_enqueue_script' );

function njimedia_debug_enqueue_style() {
  $path = plugins_url('assets/css/debugmagic.css', __FILE__ );
	wp_enqueue_style( 'njimedia_funcplug_debug_style', $path, false );
}

function njimedia_debug_enqueue_script() {
  $path = plugins_url('assets/js/debugmagic.js', __FILE__ );
	wp_enqueue_script( 'njimedia_funcplug_debug_js', $path, array('jquery'), null, true );
}

/**
 * print theme file name with some html markup.
 * Magical hidden feature: when viewing any given page, add "?pagecheck=1" to the URL
 *  to invoke the page_check function.
 *
 * @param string f full template file path (pass in __file__)
 */
function njimedia_show_theme($f){
  //return;
    if( ! defined('WP_DEBUG') || ! WP_DEBUG )
        return; // only enable if debugging turned on.

      // only run for hosts containing ".local" or .dev or .loc
    if( ! is_local_server()  )
        return;

      // optionally display results of running most all WP conditionals (see below)
    if( isset($_GET['pagecheck']) ){
        NJIMEDIA_WP_Utils::page_check();
    }

    $name = FALSE === strpos($f, 'templates') ?
      basename($f) :
      substr($f, strpos($f, 'templates'));

    echo "<script type=\"text/debug\" class=\"template-name\">{$name}</script>";
}

/**
 * Emulates JS console.log
 */
function console_log( $data ) {
  if ( empty( $data ) ){
    print '<script>console.log("Empty Data");</script>';
    print '<script>console.log(' . json_encode( $data ) . ');</script>';
  } else {
    if ( is_array( $data ) || is_object( $data ) ){
      print '<script>console.table(' . json_encode( $data ) . ');</script>';
      print '<script>console.log(' . json_encode( $data ) . ');</script>';
    } else {
      print '<script>console.log(' . json_encode( $data ) . ');</script>';
    }
  }
}

/**
 * print and die - dump a variable and immediately call die()
 * @param mixed $obj    anything that php's print_r can handle
 * @param string $die_status   [optional] a status string to pass to the die() func.
 */
function pdie($obj, $die_status="\n---- Execution Halted Here ---"){
    print_r($obj); die($die_status);
}




/**
 * Reusable wordpress utils class
 * @author
 * @version 0.1
 */
class NJIMEDIA_WP_Utils
{

    var $version = 0.1;


    // constructor... duh.
    function __construct() {
    }

    function __destruct() {
    }


    /**
     * page_check   - List output of each of WP's conditional tags (like is_page() )
     *
     * @usage <?php NJIMEDIA_WP_Utils::page_check(); ?>
     */
    public static function check_page(){NJIMEDIA_WP_Utils::page_check();}
    public static function page_check()
    {
        global $wp_query;
        $conditions = array(
          'is_home()',
          'is_front_page()',
          '$wp_query->is_posts_page',
          'is_page()',
          'is_single()',
          'is_singular()',
          'is_attachment()',
          'is_search()',
          'is_archive()',
          'is_category()',
          'is_tag()',
          'is_tax()',
          'is_author()',
          'is_day()',
          'is_month()',
          'is_year()',
          'is_time()',
          'is_date()',
          'is_paged()',
          'is_comments_popup()',
          'is_preview()',
          'is_404()',
        );

        echo '<h2>Conditional Tag</h2><ul>';
          $i = 0;
          foreach ( $conditions as $condition ) :
            $condition = str_replace('()', '', $conditions[$i]);
            switch ( $condition ) :
              case 'is_front_page' :
                $query = is_front_page();
                break;
              case '$wp_query->is_posts_page' :
                $query = $wp_query->is_posts_page;
                break;
              default :
                $query = $wp_query->$condition;
                break;
            endswitch;

            echo '<li><code>' . $conditions[$i] . '</code>';
            echo $query ? ': <span style="color:green;font-weight:bold;"> true</span>' : ' : <span style="color:red"> false</span>';
            echo '</li>';

            $i++;
           endforeach;
           echo '<li>Post Type = <code>' . get_post_type()  . '</code>';
        echo '</ul>';
    }

}

