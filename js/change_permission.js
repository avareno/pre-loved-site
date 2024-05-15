document.addEventListener('DOMContentLoaded', function() {
    var checkbox = document.getElementById('seller_checkbox');
    var hiddenInput = document.getElementById('become_seller');

    checkbox?.addEventListener('change', function() {
        hiddenInput.value = checkbox?.checked ? 'become_seller' : '';
        // Trigger form submission when checkbox state changes
        checkbox.form.submit();
    });
});

document.addEventListener('DOMContentLoaded', function() {
    var checkbox = document.getElementById('user_checkbox');
    var hiddenInput = document.getElementById('become_user');

    checkbox?.addEventListener('change', function() {
        hiddenInput.value = checkbox?.checked ? 'become_user' : '';
        // Trigger form submission when checkbox state changes
        checkbox.form.submit();
    });
});



