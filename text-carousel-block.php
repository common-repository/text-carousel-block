<?php
/*
Plugin Name: Text Carousel Block
Plugin URI: https://tishonator.com/plugins/text-carousel-block
Description: Text Carousel Block is a simple plugin that adds a Gutenberg block for inserting Text Content Carousel to your posts and pages. Fully responsive and accessible.
Author: tishonator
Version: 1.0.1
Author URI: http://tishonator.com/
Contributors: tishonator
Text Domain: text-carousel-block
*/

if ( !class_exists('tishonator_tcb_TextCarouselBlockPlugin') ) :

    /**
     * Register the plugin.
     *
     * Display the administration panel, insert JavaScript etc.
     */
    class tishonator_tcb_TextCarouselBlockPlugin {
        
    	/**
    	 * Instance object
    	 *
    	 * @var object
    	 * @see get_instance()
    	 */
    	protected static $instance = NULL;


        /**
         * Constructor
         */
        public function __construct() {}

        /**
         * Setup
         */
        public function setup() {

            add_action( 'init', array(&$this, 'register_scripts') );

            // register a block to display team members
            add_action( 'init', array(&$this, 'register_block') );
        }

        /**
         * Register scripts used to display team members
         */
        public function register_scripts() {

            if ( !is_admin() ) {

                // FontAwesome
                wp_register_style('font-awesome',
                    plugins_url('css/font-awesome.min.css', __FILE__), true);

                wp_enqueue_style( 'font-awesome',
                    plugins_url('css/font-awesome.min.css', __FILE__), array( ) );
                
                // Text Carousel Block CSS
                wp_register_style('text-carousel-block-css',
                    plugins_url('css/text-carousel-block.css', __FILE__), true);

                wp_enqueue_style( 'text-carousel-block-css',
                    plugins_url('css/text-carousel-block.css', __FILE__), array( ) );

                // Text Carousel Block JS
                wp_register_script('text-carousel-block-js',
                    plugins_url('js/text-carousel-block.js', __FILE__), array('jquery'));

                wp_enqueue_script('text-carousel-block-js',
                        plugins_url('js/text-carousel-block.js', __FILE__), array('jquery') );
            }
        }

        /*
         * Register Block
         */
        public function register_block() {

            global $pagenow;

            $arrDeps = ($pagenow === 'widgets.php') ?
                array( 'wp-edit-widgets', 'wp-blocks', 'wp-i18n', 'wp-element', )
              : array( 'wp-editor', 'wp-blocks', 'wp-i18n', 'wp-element', );

            // Text Carousel Item
            wp_register_script(
                'tishonator-text-carousel-item-block',
                plugins_url('js/text-carousel-item.js', __FILE__),
                $arrDeps
            );

            register_block_type( 'tishonator/text-carousel-item-block', array(
                'editor_script' => 'tishonator-text-carousel-item-block',
            ) );
        }

    	/**
    	 * Used to access the instance
         *
         * @return object - class instance
    	 */
    	public static function get_instance() {

    		if ( NULL === self::$instance ) {
                self::$instance = new self();
            }

    		return self::$instance;
    	}
    }

endif; // tishonator_tcb_TextCarouselBlockPlugin

add_action('plugins_loaded',
    array( tishonator_tcb_TextCarouselBlockPlugin::get_instance(), 'setup' ), 10);
