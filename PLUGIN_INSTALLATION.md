# 🚀 WordPress Plugin Installation Guide

## ✅ Your Plugin is Ready!

You now have a proper WordPress plugin structure:

```
simple-checkout-woocommerce-wordpress/
├── simple-woocommerce-checkout.php (main plugin file)
├── readme.txt (plugin information)
├── assets/
│   ├── checkout-style.css
│   └── checkout-script.js
└── templates/
    └── checkout-form.php
```

## 📦 Installation Steps

### Method 1: ZIP Upload (Easiest)
1. **Zip the entire folder** `single-checkout-woocommerce-wordpress`
2. **Go to WordPress Admin** → Plugins → Add New
3. **Click "Upload Plugin"**
4. **Choose your ZIP file**
5. **Click "Install Now"**
6. **Activate the plugin**

### Method 2: FTP Upload
1. **Upload the entire folder** to `/wp-content/plugins/`
2. **Go to WordPress Admin** → Plugins
3. **Find "Simple WooCommerce Checkout"**
4. **Click "Activate"**

## 🎯 How to Use

**After activation, use the shortcode:**

### Basic Usage:
```
[simple_checkout]
```

### With Your Product IDs:
```
[simple_checkout main_product_id="29441" upsell_product_id="YOUR_UPSELL_ID"]
```

### Where to Use:
- **Any Page/Post**: Just add the shortcode
- **Widgets**: Add a text widget with the shortcode
- **Theme Files**: `<?php echo do_shortcode('[simple_checkout]'); ?>`

## ⚙️ Configuration

The plugin is already configured with:
- **Main Product ID: 29441** ✅
- **Upsell Product ID: 29442** (update this when you create your upsell product)
- **Prices: 19€ main, 17€ upsell**

## 🔧 Next Steps

1. **Install the plugin** (zip and upload)
2. **Activate it** 
3. **Create a new page** and add `[simple_checkout]`
4. **Test it!**
5. **Create your upsell product** and update the ID

## 🎉 That's It!

Your checkout form will work immediately after installation. No complex setup needed!

**Need help?** The plugin includes:
- Automatic WooCommerce integration
- Form validation
- Mobile responsive design
- Spanish language interface
- AJAX form submission

**Ready to zip and install?** 📦