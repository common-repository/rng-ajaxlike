<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class rajl_init {

    /**
     * plugin version
     * @var Integer
     */
    public $version;

    /**
     * plugin slug used for text domain
     * @var Integer
     */
    public $slug;

    /**
     * constructor
     * @param Integer $version
     * @param Integer $slug
     */
    public function __construct($version, $slug) {
        $this->version = $version;
        $this->slug = $slug;
        add_action('plugins_loaded', array($this, 'add_text_domain'));
        add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_scripts'));
        add_action('wp_enqueue_scripts', array($this, 'public_enqueue_scripts'));
        $this->load_modules();
    }

    /**
     * add text domain with rng-ajaxlike
     * call translate string file
     * configure multilanguage plugin
     */
    public function add_text_domain() {
        load_plugin_textdomain($this->slug, FALSE, RAJL_PRT . "/languages");
    }

    /**
     * enqueue admin scripts and style
     * @param Array $hooks
     */
    public function admin_enqueue_scripts($hooks) {
        wp_enqueue_style('wp-color-picker');
        wp_enqueue_style("lj-admin-style", RAJL_PDU . "/assets/css/admin-style.css");
        wp_enqueue_script("lj-admin-script", RAJL_PDU . "assets/js/admin-script.js", array("jquery", "wp-color-picker"), "", TRUE);
    }

    /**
     * enqueue public script and style
     */
    public function public_enqueue_scripts() {
        wp_enqueue_style("lj-style", RAJL_PDU . "/assets/css/style.css");
        wp_enqueue_script("lj-script", RAJL_PDU . "/assets/js/script.js", array("jquery"), "", TRUE);
    }

    /**
     * load plugin class file as modules
     */
    private function load_modules() {
        include trailingslashit(__DIR__) . "class.controller.settings.php";
        include trailingslashit(__DIR__) . "class.controller.like.php";
        include trailingslashit(__DIR__) . "widgets/mostliked-posts.php";
		include trailingslashit(__DIR__) . "translate.php";
    }

}
