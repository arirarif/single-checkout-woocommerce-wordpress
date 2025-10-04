# Simple Checkout Setup Guide

## ✅ Files Created
1. **simple-checkout.php** - Main checkout form
2. **checkout-style.css** - Styling 
3. **checkout-script.js** - JavaScript functionality
4. **process-payment.php** - Payment processing

## 🔧 Setup Steps

### 1. Product IDs ✅
**Main Product ID: 29441** - Already configured!

**Upsell Product ID: 29442** - Update this in both files when you create your upsell product:
- `simple-checkout.php` (line with `upsell_product_id`)  
- `process-payment.php` (line with `upsell_product_id`)

### 2. Add Strategy Pack Image
Place your strategy pack image as: `strategy-pack-image.jpg`

### 3. WordPress Integration (Optional)
If using within WordPress, add this to your theme's `functions.php`:

```php
// Pre-fill checkout fields from custom form
add_action('woocommerce_checkout_init', function($checkout) {
    if (isset($_GET['from_custom_form']) && WC()->session->get('custom_checkout_data')) {
        $data = WC()->session->get('custom_checkout_data');
        $_POST['billing_first_name'] = $data['customer_name'];
        $_POST['billing_email'] = $data['customer_email'];
        $_POST['payment_method'] = $data['payment_method'] === 'paypal' ? 'paypal' : 'stripe';
    }
});

// Save custom data with order
add_action('woocommerce_checkout_order_processed', function($order_id) {
    if (WC()->session->get('custom_checkout_data')) {
        $data = WC()->session->get('custom_checkout_data');
        update_post_meta($order_id, '_marketing_consent', $data['marketing_consent']);
        update_post_meta($order_id, '_upsell_added', $data['add_upsell']);
        WC()->session->__unset('custom_checkout_data');
    }
});
```

## 🚀 How It Works

1. **Customer fills form** → Validates input
2. **Submits form** → Adds products to WooCommerce cart
3. **Redirects to checkout** → Uses WooCommerce payment processing
4. **Completes payment** → Standard WooCommerce order flow

## 📋 What You Need to Provide

**Just send me:**
- Main product ID (STARTER PACK)
- Upsell product ID (Strategy pack)
- Strategy pack image (optional)

Then you're ready to go! 🎉

## 🔄 Testing

1. Create your products in WooCommerce
2. Update the product IDs in the files
3. Upload files to your server
4. Visit `simple-checkout.php`
5. Test the form!

**Simple, clean, and functional!**