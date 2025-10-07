<?php
/**
 * Plugin Name: Simple WooCommerce Checkout
 * Plugin URI: https://yoursite.com
 * Description: A simple custom checkout form for WooCommerce with upsell functionality - English version
 * Version: 1.0.0
 * Author: Your Name
 * License: GPL v2 or later
 * Text Domain: simple-wc-checkout
 * Domain Path: /languages
 * Requires at least: 5.0
 * Tested up to: 6.3
 * Requires PHP: 7.4
 * WC requires at least: 5.0
 * WC tested up to: 8.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('SWC_PLUGIN_URL', plugin_dir_url(__FILE__));
define('SWC_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('SWC_VERSION', '1.0.0');

/**
 * Main Plugin Class
 */
class SimpleWooCommerceCheckout {
    
    public function __construct() {
        add_action('init', array($this, 'init'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        register_activation_hook(__FILE__, array($this, 'activate'));
        register_deactivation_hook(__FILE__, array($this, 'deactivate'));
    }
    
    /**
     * Initialize plugin
     */
    public function init() {
        // Check if WooCommerce is active
        if (!class_exists('WooCommerce')) {
            add_action('admin_notices', array($this, 'woocommerce_missing_notice'));
            return;
        }
        
        // Add shortcode
        add_shortcode('simple_checkout', array($this, 'checkout_shortcode'));
        
        // Add AJAX handlers
        add_action('wp_ajax_process_simple_checkout', array($this, 'process_checkout'));
        add_action('wp_ajax_nopriv_process_simple_checkout', array($this, 'process_checkout'));
        
        // Add hooks for checkout processing
        add_action('woocommerce_checkout_init', array($this, 'prefill_checkout'));
        add_action('woocommerce_checkout_order_processed', array($this, 'save_custom_data'));
    }
    
    /**
     * Enqueue scripts and styles
     */
    public function enqueue_scripts() {
        wp_enqueue_style(
            'simple-checkout-style',
            SWC_PLUGIN_URL . 'assets/checkout-style.css',
            array(),
            SWC_VERSION
        );
        
        wp_enqueue_script(
            'simple-checkout-script',
            SWC_PLUGIN_URL . 'assets/checkout-script.js',
            array('jquery'),
            SWC_VERSION,
            true
        );
        
        // Localize script for AJAX
        wp_localize_script('simple-checkout-script', 'simple_checkout_ajax', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('simple_checkout_nonce')
        ));
    }
    
    /**
     * Checkout shortcode
     */
    public function checkout_shortcode($atts) {
        $atts = shortcode_atts(array(
            'main_product_id' => '29441',
            'upsell_product_id' => '29914',
            'main_price' => '19.00',
            'upsell_price' => '17.00'
        ), $atts);
        
        ob_start();
        include(SWC_PLUGIN_PATH . 'templates/checkout-form.php');
        return ob_get_clean();
    }
    
    /**
     * Process checkout via AJAX
     */
    public function process_checkout() {
        // Verify nonce
        if (!wp_verify_nonce($_POST['nonce'], 'simple_checkout_nonce')) {
            wp_die('Security check failed');
        }
        
        // Sanitize input data
        $customer_name = sanitize_text_field($_POST['customer_name'] ?? '');
        $customer_email = sanitize_email($_POST['customer_email'] ?? '');
        $marketing_consent = isset($_POST['marketing_consent']) ? 1 : 0;
        $payment_method = sanitize_text_field($_POST['payment_method'] ?? 'card');
        $add_upsell = isset($_POST['add_upsell']) ? 1 : 0;
        
        // Product IDs
        $main_product_id = intval($_POST['main_product_id'] ?? 29441); // STARTER PACK: Passive Income
        $upsell_product_id = intval($_POST['upsell_product_id'] ?? 29914); // Strategy Pack
        
        // Validate required fields
        $errors = array();
        
        if (empty($customer_name) || strlen($customer_name) < 2) {
            $errors[] = 'Name is required (minimum 2 characters)';
        }
        
        if (empty($customer_email) || !is_email($customer_email)) {
            $errors[] = 'Valid email is required';
        }
        
        if (!empty($errors)) {
            wp_send_json_error(array('message' => implode(', ', $errors)));
            return;
        }
        
        try {
            // Clear existing cart
            WC()->cart->empty_cart();
            
            // Add main product to cart
            $main_product = wc_get_product($main_product_id);
            if (!$main_product || !$main_product->exists()) {
                throw new Exception('Main product not found (ID: ' . $main_product_id . ')');
            }
            
            $cart_item_key = WC()->cart->add_to_cart($main_product_id, 1);
            if (!$cart_item_key) {
                throw new Exception('Error adding main product to cart');
            }
            
            // Add upsell product if selected
            if ($add_upsell) {
                $upsell_product = wc_get_product($upsell_product_id);
                if ($upsell_product && $upsell_product->exists()) {
                    WC()->cart->add_to_cart($upsell_product_id, 1);
                }
            }
            
            // Store customer data in session
            WC()->session->set('custom_checkout_data', array(
                'customer_name' => $customer_name,
                'customer_email' => $customer_email,
                'marketing_consent' => $marketing_consent,
                'payment_method' => $payment_method,
                'add_upsell' => $add_upsell
            ));
            
            // Return checkout URL
            $checkout_url = add_query_arg(array(
                'from_custom_form' => '1'
            ), wc_get_checkout_url());
            
            wp_send_json_success(array(
                'checkout_url' => $checkout_url,
                'message' => 'Products added to cart successfully'
            ));
            
        } catch (Exception $e) {
            wp_send_json_error(array('message' => 'Error: ' . $e->getMessage()));
        }
    }
    
    /**
     * Pre-fill checkout fields
     */
    public function prefill_checkout($checkout) {
        if (isset($_GET['from_custom_form']) && WC()->session->get('custom_checkout_data')) {
            $data = WC()->session->get('custom_checkout_data');
            
            $_POST['billing_first_name'] = $data['customer_name'];
            $_POST['billing_email'] = $data['customer_email'];
        }
    }
    
    /**
     * Save custom data with order
     */
    public function save_custom_data($order_id) {
        if (WC()->session->get('custom_checkout_data')) {
            $data = WC()->session->get('custom_checkout_data');
            
            update_post_meta($order_id, '_marketing_consent', $data['marketing_consent']);
            update_post_meta($order_id, '_upsell_added', $data['add_upsell']);
            update_post_meta($order_id, '_custom_form_source', 1);
            
            // Clear session data
            WC()->session->__unset('custom_checkout_data');
        }
    }
    
    /**
     * WooCommerce missing notice
     */
    public function woocommerce_missing_notice() {
        echo '<div class="error"><p><strong>Simple WooCommerce Checkout</strong> requires WooCommerce to be installed and active.</p></div>';
    }
    
    /**
     * Plugin activation
     */
    public function activate() {
        // Create necessary database tables or options if needed
        flush_rewrite_rules();
    }
    
    /**
     * Plugin deactivation
     */
    public function deactivate() {
        flush_rewrite_rules();
    }
}

// Initialize the plugin
new SimpleWooCommerceCheckout();