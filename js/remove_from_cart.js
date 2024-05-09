$(document).ready(function() {
    $(".remove-from-cart").click(function() {
        var productId = $(this).data("product-id");
        var listItem = document.querySelector("#product_" + productId);
        
        // Remover o item do carrinho da lista
        if (listItem) {
            listItem.parentNode.removeChild(listItem);
        }
    });
});
