$(document).ready(function() {
    $(".remove-from-cart").click(function() {
        const productId = $(this).data("product-id");
        const listItem = document.querySelector("#product_" + productId);
        
        // Remover o item do carrinho da lista
        if (listItem) {
            listItem.parentNode.removeChild(listItem);
        }
    });
});
