=== Simple WooCommerce Checkout ===
Contributors: yourname
Tags: woocommerce, checkout, upsell, english
Requires at least: 5.0
Tested up to: 6.3
Requires PHP: 7.4
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A simple custom checkout form for WooCommerce with upsell functionality, designed for English-speaking users.

== Description ==

Simple WooCommerce Checkout creates a beautiful, custom checkout form with:

* Contact information section (Name, Email)
* Payment method selection (Credit Card, PayPal) 
* Optional upsell section with promotional content
* Order summary with dynamic total calculation
* English language interface
* Mobile responsive design

Perfect for digital product sales with upsell offers.

== Installation ==

1. Upload the plugin files to `/wp-content/plugins/simple-woocommerce-checkout/`
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Make sure WooCommerce is installed and active
4. Use the shortcode `[simple_checkout]` on any page or post

== Usage ==

**Basic shortcode:**
`[simple_checkout]`

**With custom product IDs:**
`[simple_checkout main_product_id="29441" upsell_product_id="29442"]`

**With custom prices:**
`[simple_checkout main_price="19.00" upsell_price="17.00"]`

== Frequently Asked Questions ==

= Does this require WooCommerce? =
Yes, WooCommerce must be installed and active.

= Can I customize the product IDs? =
Yes, use the shortcode attributes: `main_product_id` and `upsell_product_id`

= Is it mobile responsive? =
Yes, the form is fully responsive and works great on mobile devices.

= Can I change the language? =
The plugin is designed for English, but you can modify the template file for other languages.

== Screenshots ==

1. Complete checkout form with all 4 sections
2. Contact information section
3. Payment method selection
4. Upsell promotional section
5. Order summary

== Changelog ==

= 1.0.0 =
* Initial release
* Contact form with validation
* Payment method selection
* Upsell functionality
* English language interface
* Mobile responsive design

== Upgrade Notice ==

= 1.0.0 =
Initial release of Simple WooCommerce Checkout plugin.