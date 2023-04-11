function addProduct(price) {
    let quantity = parseInt($('input#qty-val').val());
    let afterQuantity = quantity + 1;
    $('input#qty-val').val(afterQuantity);
    $('.total h4').html("Total: $" + afterQuantity * price);
    return afterQuantity;
}

function minusProduct(price) {
    let quantity = parseInt($('input#qty-val').val());
    let afterQuantity = quantity - 1;
    if (afterQuantity > 1) {
        $('input#qty-val').val(--quantity);
        $('.total h4').html("Total: $" + (--quantity) * price);
    } else {
        $('input#qty-val').val(1);
    }
    return afterQuantity;
}
