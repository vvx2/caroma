function LoadCart() {
    var token = $('#token').val();
    $.post('api/cart.php', {
        type: 'getcart',
        token: token
    }, function (data) {
        data = JSON.parse(data)
        // console.log("getcart:");
        // console.log(data);
        $('#token').val(data["Token"]);
        $('#form_token').val(data["Token"]);
        if (data["Status"]) {
            //Success Action
            let cart = '';

            $.each(data["cart"], function (key, product) {
                if (product.is_promo == 1) {
                    display_ori_price = '                   <del><span class="price-amount"><span class="currencySymbol">RM </span>' + parseFloat(product.ori_price).toFixed(2) + '</span></del>\n';
                } else {
                    display_ori_price = '                   <del ><span class="price-amount"><span class="currencySymbol"></span></span></del>\n';
                }
                cart = cart +
                    '   <li>\n' +
                    '       <div class="minicart-item">\n' +
                    '           <div class="thumb">\n' +
                    '               <a href="products-detail.php?p=' + key + '"><img src="img/product/' + product.image + '" width="90" height="90" alt="' + product.name + '"></a>\n' +
                    '           </div>\n' +
                    '           <div class="left-info">\n' +
                    '               <div class="product-title"><a href="products-detail.php?p=' + key + '" class="product-name">' + product.name + '</a></div>\n' +
                    '               <div class="price">\n' +
                    '                   <ins><span class="price-amount"><span class="currencySymbol">RM </span>' + parseFloat(product.price).toFixed(2) + '</span></ins>\n' +
                    display_ori_price +
                    '               </div>\n' +
                    '               <div class="qty">\n' +
                    '                   <label for="cart[id123]">Qty:</label>\n' +
                    '                   <input type="number" class="input-qty" name="cart[id123]" id="cart[id123]" value="' + product.qty + '" disabled>\n' +
                    '               </div>\n' +
                    '             </div>\n' +
                    '           <div class="action">\n' +
                    '               <a class="remove_cart" data-cart-value="' + key + '"><i class="fa fa-trash-o" aria-hidden="true"></i></a>\n' +
                    '           </div>\n' +
                    '       </div>\n' +
                    '   </li>\n';
            });

            $(".cart_product").html(cart);
            $(".sub-total").html('RM ' + data["total_price"].toFixed(2));
            $(".number_cart").html(data["number_cart"]);
            if (data["number_cart"] == 0) {
                $(".view-cart").attr('disabled', true);
                $(".cart_checkout").attr('disabled', true);
            } else {
                $(".view-cart").attr('disabled', false);
                $(".cart_checkout").attr('disabled', false);
            }

            if (data["login"] != 1) {
                $(".cart_checkout").attr('disabled', true);
                $(".checkout").attr('disabled', true);
            }
        } else {
            //Failed Action
        }
    });
}

function AddToCart(product_id, product_qty, thisbtn, token) {
    $.post('api/cart.php', {
        type: 'addtocart',
        product_id: product_id,
        product_qty: product_qty,
        token: token
    }, function (data) {
        data = JSON.parse(data)
        // console.log("-------------------------");
        // console.log(data);
        $('#token').val(data["Token"]);
        if (data["Status"]) {
            //Success Action
            thisbtn.html('<i class="fa fa-check animated fadeIn"></i> Added');

            setTimeout(function () {
                thisbtn.html('ADD TO CART');
                thisbtn.attr('disabled', false);
            }, 1000);
        } else {
            //Failed Action
            thisbtn.html('<i class="fa fa-times animated fadeIn"></i> ' + data["Msg"]);
            setTimeout(function () {
                thisbtn.html('ADD TO CART');
                thisbtn.attr('disabled', false);
            }, 1000);
        }
        LoadCart();
    });
}

function RemoveFromCart(product_id, thisbtn, token) {
    $.post('api/cart.php', {
        type: 'removefromcart',
        product_id: product_id,
        token: token
    }, function (data) {
        data = JSON.parse(data)
        // console.log("-------------------------");
        // console.log(data);
        $('#token').val(data["Token"]);
        if (data["Status"]) {
            //Success Action
            thisbtn.html('<i class="fa fa-times animated fadeIn"></i> Deleted');
        } else {
            //Failed Action
            thisbtn.html('<i class="fa fa-times animated fadeIn"></i> ' + data["Msg"]);
            setTimeout(function () {
                thisbtn.html('<a href="#" class="remove_cart" data-cart-value="' + product_id + '"><i class="fa fa-trash-o" aria-hidden="true"></i></a>');
                thisbtn.attr('disabled', false);
            }, 500);
        }
        LoadCart();
    });
}

function ClearCart(thisbtn, token) {
    $.post('api/cart.php', {
        type: 'clearcart',
        token: token
    }, function (data) {
        // console.log(data);
        data = JSON.parse(data)
        // console.log("-------------------------");
        // console.log(data);
        $('#token').val(data["Token"]);
        if (data["Status"]) {
            location.reload();
            //Success Action
        } else {
            //Failed Action
            thisbtn.html('<i class="fa fa-times animated fadeIn"></i> ' + data["Msg"]);
            setTimeout(function () {
                location.reload();
            }, 500);
        }
    });
}

$('.btn-clear').click(function () {
    var thisbtn = $(this);
    var token = $('#token').val();
    ClearCart(thisbtn, token);
});

// $('[class="btnAddCart"]').click(function () {
//     var thisbtn = $(this);
//     let data = new FormData();
//     var product_id = thisbtn.data('value');
//     var product_qty = $('[name="qty_product"]').val();
//     if (product_qty) {
//         product_qty = product_qty;
//     } else {
//         product_qty = 1;
//     }
//     var token = $('#token').val();
//     thisbtn.attr('disabled', true);
//     thisbtn.html('<i class="fa fa-spin fa-spinner"></i> Loading...');
//     console.log('qty:' + product_qty);
//     AddToCart(product_id, product_qty, thisbtn, token);
// });

$(document).on('click', '.btnAddCart', function () {
    var thisbtn = $(this);
    let data = new FormData();
    var product_id = thisbtn.data('value');
    var product_qty = $('[name="qty_product"]').val();
    if (product_qty) {
        product_qty = product_qty;
    } else {
        product_qty = 1;
    }
    var token = $('#token').val();
    thisbtn.attr('disabled', true);
    thisbtn.html('<i class="fa fa-spin fa-spinner"></i> Loading...');
    AddToCart(product_id, product_qty, thisbtn, token);
});

$(document).on('click', '.remove_cart', function () {
    var thisbtn = $(this);
    let data = new FormData();
    var product_id = thisbtn.data('cart-value');
    var token = $('#token').val();
    thisbtn.attr('disabled', true);
    thisbtn.html('<i class="fa fa-spin fa-spinner"></i> Loading...');
    RemoveFromCart(product_id, thisbtn, token);
});

$('[class="change_language"]').click(function () {
    var language = $(this).data('value');
    console.log("lang:" + language);
    $.post('api/change_language.php', {
        language: language
    }, function (data) {
        console.log("langauge api: " + data);
        data = JSON.parse(data);
        if (data["Status"]) {
            location.reload();
        }
    });
});
