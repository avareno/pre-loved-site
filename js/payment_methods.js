function handlePaymentMethodChange() {
    const paymentMethod = document.getElementById('payment-method').value;
    const paymentCredentialsContainer = document.querySelector('.checkout-payment.' + paymentMethod + '-details');

    const allPaymentDetails = document.querySelectorAll('.checkout-payment');
    allPaymentDetails.forEach(function (element) {
        element.style.display = 'none';
    });

    paymentCredentialsContainer.style.display = 'block';
}

document.addEventListener('DOMContentLoaded', function () {
    const paymentMethodSelect = document.getElementById('payment-method');
    paymentMethodSelect.addEventListener('change', function () {
        handlePaymentMethodChange();
    });
});
