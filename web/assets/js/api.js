

function getProductDetails(product_id) {
    $.ajax({
        type: 'POST',
        url: 'http://127.0.0.1:8000/api/product',
        contentType: 'aplication/json',
        success: function(data) {
            console.log(data);
        },
        crossDomain: true

    })
}