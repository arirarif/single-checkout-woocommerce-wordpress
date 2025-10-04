<div class="checkout-container">
    <form id="simple-checkout-form" class="simple-checkout-form">
        
        <!-- SECTION 1: Contact Information -->
        <div class="section contact-section">
            <h2>Contact Information</h2>
            
            <div class="form-group">
                <input type="text" 
                       name="customer_name" 
                       id="customer_name" 
                       placeholder="Your Name" 
                       required>
            </div>
            
            <div class="form-group">
                <input type="email" 
                       name="customer_email" 
                       id="customer_email" 
                       placeholder="Your Best Email" 
                       required>
            </div>
            
            <div class="form-group checkbox-group">
                <label>
                    <input type="checkbox" name="marketing_consent" id="marketing_consent">
                    I consent to receive educational and promotional emails.
                </label>
            </div>
            
            <div class="form-group">
                <p class="terms-text">
                    I have read and accept the <a href="#" target="_blank">terms and conditions</a> of this page.
                </p>
            </div>
        </div>

        <!-- SECTION 2: Payment Method -->
        <div class="section payment-section">
            <h2>Choose your payment method:</h2>
            
            <div class="payment-methods">
                <!-- Credit/Debit Card Option -->
                <div class="payment-option">
                    <label class="payment-label">
                        <input type="radio" name="payment_method" value="card" checked>
                        <span class="payment-text">Credit or Debit Card</span>
                        <div class="card-icons">
                            <span style="color: #1a1f71; font-weight: bold;">VISA</span>
                            <span style="color: #eb001b; font-weight: bold;">MC</span>
                            <span style="color: #006fcf; font-weight: bold;">AMEX</span>
                            <span style="color: #ff6000; font-weight: bold;">DISC</span>
                        </div>
                    </label>
                    
                    <div class="card-form" id="card-form">
                        <div class="form-group">
                            <input type="text" 
                                   name="card_number" 
                                   id="card_number" 
                                   placeholder="1234 1234 1234 1234" 
                                   maxlength="19">
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group half">
                                <input type="text" 
                                       name="card_expiry" 
                                       id="card_expiry" 
                                       placeholder="MM / YY" 
                                       maxlength="7">
                            </div>
                            <div class="form-group half">
                                <input type="text" 
                                       name="card_cvc" 
                                       id="card_cvc" 
                                       placeholder="CVC" 
                                       maxlength="4">
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- PayPal Option -->
                <div class="payment-option">
                    <label class="payment-label">
                        <input type="radio" name="payment_method" value="paypal">
                        <span class="payment-text">PayPal</span>
                        <span style="color: #0070ba; font-weight: bold; font-size: 18px;">PayPal</span>
                    </label>
                </div>
            </div>
        </div>

        <!-- SECTION 3: Upsell Strategy Pack -->
        <div class="section upsell-section">
            <div class="upsell-box">
                <div class="upsell-header">
                    <span class="arrow">➤</span>
                    <label>
                        <input type="checkbox" name="add_upsell" id="add_upsell" onchange="updateTotal()">
                        Add the strategy to create a sales page that converts visitors into buyers, for only $17
                    </label>
                </div>
                
                <div class="upsell-content">
                    <div class="upsell-image">
                        <div class="strategy-image" style="background: #333; display: flex; align-items: center; justify-content: center; color: white; font-size: 12px;">Strategy Pack</div>
                    </div>
                    
                    <div class="upsell-details">
                        <h3>HIGHLY RECOMMENDED:</h3>
                        
                        <p><strong>Important:</strong> If you really want your digital product to not only be good... but for your audience to perceive it and be willing to buy, we recommend updating your order to include The strategy to create sales pages that attract and convert visitors into buyers.</p>
                        
                        <p>This pack gives you the exact structure I use with my clients to transform visitors into buyers with clear, strategic and compelling texts.</p>
                        
                        <ul class="benefits-list">
                            <li>✅ Learn how to capture attention from the first second</li>
                            <li>✅ Discover the key sections that increase purchase desire</li>
                            <li>✅ Includes real examples and step-by-step guide to gather all information and write your own page</li>
                        </ul>
                        
                        <div class="pricing">
                            <span class="original-price">💰 Normally $97.</span>
                            <span class="discount-price">Add it now for only $17.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SECTION 4: Order Summary -->
        <div class="section order-section">
            <h2>Order Details</h2>
            
            <div class="order-summary">
                <div class="order-item">
                    <span class="item-icon">🔵</span>
                    <span class="item-name">STARTER PACK: Passive Income</span>
                    <span class="item-price">$19.00</span>
                </div>
                
                <div class="order-item upsell-item" id="upsell-item" style="display: none;">
                    <span class="item-icon">📚</span>
                    <span class="item-name">Sales Strategy</span>
                    <span class="item-price">$17.00</span>
                </div>
                
                <div class="order-total">
                    <span class="total-label">Total:</span>
                    <span class="total-amount" id="total-amount">$19.00</span>
                </div>
            </div>
            
            <button type="submit" class="checkout-button" id="checkout-button">
                Complete Payment
            </button>
        </div>

        <!-- Hidden fields for product IDs -->
        <input type="hidden" name="main_product_id" value="<?php echo esc_attr($atts['main_product_id']); ?>">
        <input type="hidden" name="upsell_product_id" value="<?php echo esc_attr($atts['upsell_product_id']); ?>">
        <input type="hidden" name="main_price" value="<?php echo esc_attr($atts['main_price']); ?>">
        <input type="hidden" name="upsell_price" value="<?php echo esc_attr($atts['upsell_price']); ?>">
        <input type="hidden" name="action" value="process_simple_checkout">
        <input type="hidden" name="nonce" value="<?php echo wp_create_nonce('simple_checkout_nonce'); ?>">
        
    </form>
</div>

<script>
// Update the JavaScript to use AJAX instead of form submission
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('simple-checkout-form');
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(form);
        const button = document.getElementById('checkout-button');
        
        // Show loading
        button.textContent = 'Processing...';
        button.disabled = true;
        
        // Submit via AJAX
        fetch(simple_checkout_ajax.ajax_url, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Redirect to checkout
                window.location.href = data.data.checkout_url;
            } else {
                alert('Error: ' + data.data.message);
                button.textContent = 'Complete Payment';
                button.disabled = false;
            }
        })
        .catch(error => {
            alert('Error processing order');
            button.textContent = 'Complete Payment';
            button.disabled = false;
        });
    });
});
</script>