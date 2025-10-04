// Simple Checkout Form JavaScript
document.addEventListener('DOMContentLoaded', function() {
    
    // Form elements
    const form = document.getElementById('simple-checkout-form') || document.getElementById('checkout-form');
    const addUpsellCheckbox = document.getElementById('add_upsell');
    const upsellItem = document.getElementById('upsell-item');
    const totalAmount = document.getElementById('total-amount');
    const cardForm = document.getElementById('card-form');
    const paymentMethods = document.querySelectorAll('input[name="payment_method"]');
    
    // Prices
    const mainPrice = 19.00;
    const upsellPrice = 17.00;
    
    // Initialize
    updateTotal();
    setupPaymentMethodToggle();
    setupCardFormatting();
    setupFormValidation();
    
    // Update total when upsell is toggled
    function updateTotal() {
        let total = mainPrice;
        
        if (addUpsellCheckbox.checked) {
            total += upsellPrice;
            upsellItem.style.display = 'flex';
        } else {
            upsellItem.style.display = 'none';
        }
        
        totalAmount.textContent = '$' + total.toFixed(2);
    }
    
    // Setup payment method toggle
    function setupPaymentMethodToggle() {
        paymentMethods.forEach(function(radio) {
            radio.addEventListener('change', function() {
                if (this.value === 'paypal') {
                    cardForm.style.display = 'none';
                } else {
                    cardForm.style.display = 'block';
                }
            });
        });
    }
    
    // Setup card number formatting
    function setupCardFormatting() {
        const cardNumber = document.getElementById('card_number');
        const cardExpiry = document.getElementById('card_expiry');
        const cardCvc = document.getElementById('card_cvc');
        
        // Format card number (add spaces every 4 digits)
        cardNumber.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            let formattedValue = value.replace(/(\d{4})(?=\d)/g, '$1 ');
            if (formattedValue !== e.target.value) {
                e.target.value = formattedValue;
            }
        });
        
        // Format expiry date (MM/YY)
        cardExpiry.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length >= 2) {
                value = value.substring(0, 2) + ' / ' + value.substring(2, 4);
            }
            e.target.value = value;
        });
        
        // Only allow numbers for CVC
        cardCvc.addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/\D/g, '');
        });
    }
    
    // Form validation
    function setupFormValidation() {
        form.addEventListener('submit', function(e) {
            if (!validateForm()) {
                e.preventDefault();
                return false;
            }
            
            // Show loading state
            const submitButton = document.getElementById('checkout-button');
            submitButton.classList.add('loading');
            submitButton.textContent = 'Processing...';
        });
    }
    
    // Validate form fields
    function validateForm() {
        let isValid = true;
        const errors = [];
        
        // Validate name
        const name = document.getElementById('customer_name').value.trim();
        if (name.length < 2) {
            errors.push('Name must have at least 2 characters');
            isValid = false;
        }
        
        // Validate email
        const email = document.getElementById('customer_email').value.trim();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            errors.push('Please enter a valid email');
            isValid = false;
        }
        
        // Validate payment method
        const selectedPayment = document.querySelector('input[name="payment_method"]:checked').value;
        
        if (selectedPayment === 'card') {
            // Validate card fields
            const cardNumber = document.getElementById('card_number').value.replace(/\s/g, '');
            const cardExpiry = document.getElementById('card_expiry').value;
            const cardCvc = document.getElementById('card_cvc').value;
            
            if (cardNumber.length < 13 || cardNumber.length > 19) {
                errors.push('Invalid card number');
                isValid = false;
            }
            
            if (!cardExpiry.match(/^\d{2} \/ \d{2}$/)) {
                errors.push('Invalid expiration date (MM/YY)');
                isValid = false;
            }
            
            if (cardCvc.length < 3 || cardCvc.length > 4) {
                errors.push('Invalid CVC');
                isValid = false;
            }
            
            // Basic Luhn algorithm check
            if (!isValidCardNumber(cardNumber)) {
                errors.push('Invalid card number');
                isValid = false;
            }
        }
        
        // Show errors if any
        if (!isValid) {
            alert('Please correct the following errors:\n\n' + errors.join('\n'));
        }
        
        return isValid;
    }
    
    // Luhn algorithm for card validation
    function isValidCardNumber(cardNumber) {
        let sum = 0;
        let isEven = false;
        
        for (let i = cardNumber.length - 1; i >= 0; i--) {
            let digit = parseInt(cardNumber.charAt(i));
            
            if (isEven) {
                digit *= 2;
                if (digit > 9) {
                    digit = digit % 10 + 1;
                }
            }
            
            sum += digit;
            isEven = !isEven;
        }
        
        return sum % 10 === 0;
    }
    
    // Event listeners
    addUpsellCheckbox.addEventListener('change', updateTotal);
    
    // Add smooth animations
    upsellItem.style.transition = 'all 0.3s ease';
    
});

// Utility functions
function showError(message) {
    alert('Error: ' + message);
}

function showSuccess(message) {
    alert('Success: ' + message);
}

// Export for global access if needed
window.checkoutUtils = {
    updateTotal: function() {
        // Re-run update total if called externally
        document.getElementById('add_upsell').dispatchEvent(new Event('change'));
    }
};