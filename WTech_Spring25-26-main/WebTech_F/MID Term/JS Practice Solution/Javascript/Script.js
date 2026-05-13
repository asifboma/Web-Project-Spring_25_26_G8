// Constants
const UNIT_PRICE = 500;
const COUPON_THRESHOLD = 2000;
const DELIVERY_INSIDE = 50;
const DELIVERY_OUTSIDE = 120;

// Get DOM elements
const quantityInput = document.getElementById('quantity');
const totalPriceElement = document.getElementById('totalPrice');
const couponMessage = document.getElementById('couponMessage');
const deliverySelect = document.getElementById('delivery');
const deliveryChargeElement = document.getElementById('deliveryCharge');
const termsCheckbox = document.getElementById('terms');
const submitBtn = document.getElementById('submitBtn');

// Function to update total price
function updateTotalPrice() {
    let quantity = parseInt(quantityInput.value);
    
    // Validate quantity (cannot be zero or negative)
    if (quantity <= 0 || isNaN(quantity)) {
        quantityInput.value = 1;
        quantity = 1;
    }
    
    const totalPrice = quantity * UNIT_PRICE;
    totalPriceElement.textContent = totalPrice;
    
    // Check for coupon eligibility
    if (totalPrice > COUPON_THRESHOLD) {
        couponMessage.textContent = "You are now eligible for a coupon.";
    } else {
        couponMessage.textContent = "";
    }
}

// Function to update delivery charge
function updateDeliveryCharge() {
    const deliveryOption = deliverySelect.value;
    let deliveryCharge;
    
    if (deliveryOption === 'inside') {
        deliveryCharge = DELIVERY_INSIDE;
    } else {
        deliveryCharge = DELIVERY_OUTSIDE;
    }
    
    deliveryChargeElement.textContent = deliveryCharge;
}

// Function to toggle submit button visibility
function toggleSubmitButton() {
    if (termsCheckbox.checked) {
        submitBtn.style.display = 'block';
    } else {
        submitBtn.style.display = 'none';
    }
}

// Event listeners
quantityInput.addEventListener('input', updateTotalPrice);
quantityInput.addEventListener('change', updateTotalPrice);
deliverySelect.addEventListener('change', updateDeliveryCharge);
termsCheckbox.addEventListener('change', toggleSubmitButton);

// Submit button click handler
submitBtn.addEventListener('click', function() {
    const address = document.getElementById('address').value;
    
    if (!address.trim()) {
        alert('Please enter your shipping address!');
        return;
    }
    
    const totalPrice = parseInt(totalPriceElement.textContent);
    const deliveryCharge = parseInt(deliveryChargeElement.textContent);
    const grandTotal = totalPrice + deliveryCharge;
    
    alert(`Order submitted successfully!\nTotal Amount: ${totalPrice} Tk\nDelivery Charge: ${deliveryCharge} Tk\nGrand Total: ${grandTotal} Tk`);
});

// Initialize on page load
updateTotalPrice();
updateDeliveryCharge();
