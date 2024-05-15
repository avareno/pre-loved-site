function handlePaymentMethodChange() {
    var paymentMethod = document.getElementById('payment-method').value;
    var paymentCredentialsContainer = document.querySelector('.checkout-payment.' + paymentMethod + '-details');

    var allPaymentDetails = document.querySelectorAll('.checkout-payment');
    allPaymentDetails.forEach(function (element) {
        element.style.display = 'none';
    });

    paymentCredentialsContainer.style.display = 'block';
}

document.addEventListener('DOMContentLoaded', function () {
    var paymentMethodSelect = document.getElementById('payment-method');
    paymentMethodSelect.addEventListener('change', function () {
        handlePaymentMethodChange();
    });
});
