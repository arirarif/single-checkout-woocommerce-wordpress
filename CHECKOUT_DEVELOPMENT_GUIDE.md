# Simple WooCommerce Checkout Form

## Project Overview
A simple checkout form with 4 sections:
1. Contact info (Name, Email)
2. Payment method selection 
3. Optional upsell
4. Order total and pay button

**Keep it simple - just a form that processes payment!**

## What You Need to Provide
- **Main Product ID**: The WooCommerce product ID for "STARTER PACK: Ingresos pasivos" 
- **Upsell Product ID**: The WooCommerce product ID for the strategy pack upsell
- **Product Prices**: Confirm the prices (19€ main, 17€ upsell)

## Simple File Structure
```
single-checkout-woocommerce-wordpress/
├── simple-checkout.php (main form)
├── checkout-style.css (styling)
├── checkout-script.js (form handling)
└── process-payment.php (payment processing)
```

## Simple Implementation Plan

### What We'll Build
**A single PHP form that:**
1. Collects name and email
2. Shows payment options (card/PayPal)
3. Has optional upsell checkbox
4. Calculates total and processes payment

### Required Files
1. **simple-checkout.php** - Main form HTML
2. **checkout-style.css** - Basic styling
3. **checkout-script.js** - Form validation and total calculation
4. **process-payment.php** - WooCommerce order creation

### Quick Setup Steps
1. You create 2 products in WooCommerce
2. Give me the product IDs
3. I build the simple form
4. Form adds products to cart and redirects to WooCommerce payment

**That's it! No over-engineering, just a working checkout form.**

## Product Information Needed
Please provide:
- **Main Product ID**: [Your product ID here]
- **Main Product Price**: 19.00€
- **Upsell Product ID**: [Your upsell product ID here] 
- **Upsell Product Price**: 17.00€

## Simple Form Structure
```html
<!-- Contact Section -->
Name: [input]
Email: [input]

<!-- Payment Method -->
○ Credit Card  ○ PayPal

<!-- Upsell (Optional) -->
☐ Add strategy pack (+17€)

<!-- Total -->
Total: 19€ (or 36€ with upsell)
[Completar pago] button
```

---

## Ready to Code?

**Just provide me with:**
1. Your main product ID (STARTER PACK)
2. Your upsell product ID (Strategy pack)
3. Confirm the prices are correct (19€ and 17€)

**Then I'll create:**
- Simple checkout form
- Basic styling
- Payment processing
- Order completion

**No complexity, just a working form that takes payment!**

*Simple and effective - let's build it!*