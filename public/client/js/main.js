/*price range*/
 $('#sl2').slider();

	var RGBChange = function() {
	  $('#RGB').css('background', 'rgb('+r.getValue()+','+g.getValue()+','+b.getValue()+')')
	};

/*scroll to top*/

$(document).ready(function(){
	$(function () {
		$.scrollUp({
	        scrollName: 'scrollUp', // Element ID
	        scrollDistance: 300, // Distance from top/bottom before showing element (px)
	        scrollFrom: 'top', // 'top' or 'bottom'
	        scrollSpeed: 300, // Speed back to top (ms)
	        easingType: 'linear', // Scroll to top easing (see http://easings.net/)
	        animation: 'fade', // Fade, slide, none
	        animationSpeed: 200, // Animation in speed (ms)
	        scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
					//scrollTarget: false, // Set a custom target element for scrolling to the top
	        scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
	        scrollTitle: false, // Set a custom <a> title if required.
	        scrollImg: false, // Set true to use image
	        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
	        zIndex: 2147483647 // Z-Index for the overlay
		});
	});
});

function addCart(productId)
{
    $.ajax({
       type: "GET",
       url: "cart/add",
        data: {productId: productId},
        success: function (response){
           $('.cart-count').text(response['count']);
            $('.cart-price').text('$' + response['total']);
            $('.select-total h5').text('$' + response['total']);

            var cartHover_tbody = $('.select-items tbody');
            var cartHover_existItem = cartHover_tbody.find("tr" + "[data-rowId='"+response['cart'].rowId+"']");

            if(cartHover_existItem.length){
                cartHover_existItem.find('.product-selected p').text('$'+response['cart'].price.toFixed(2)+ '*'+response['cart'].qty);
            }
            else{
                var newItem =
                    '<tr data-row="'+ response['cart'].rowId + '">\n' +
                    '    <td className="cart_product">\n' +
                    '        <a href=""><img src="client/images/products/' + response['cart'].options.images[0].path + '" alt=""> </a>\n' +
                    '    </td>\n' +
                    '    <td className="cart_description">\n' +
                    '        <h4><a href="">$' + response['cart'].price.toFixed(2) + ' x ' + response['cart'].qty + '</a></h4>\n' +
                    '    </td>\n' +
                    '    <td className="cart_price">\n' +
                    '        <p>' + response['cart'].name + '</p>\n' +
                    '    </td>\n' +
                    '    <td className="cart_quantity">\n' +
                    '        <div className="cart_quantity_button">\n' +
                    '            <a className="cart_quantity_up" href=""> + </a>\n' +
                    '           <input className="cart_quantity_input" type="text" name="quantity" value="{{$cart->qty}}"\n' +
                    '                   autoComplete="off" size="2">\n' +
                    '                <a className="cart_quantity_down" href=""> - </a>\n' +
                    '        </div>\n' +
                    '    </td>\n' +
                    '    <td className="cart_total">\n' +
                    '        <p className="cart_total_price"></p>\n' +
                    '    </td>\n' +
                    '    <td className="cart_delete">\n' +
                    '        <a className="cart_quantity_delete" href="cart/delete/{{$cart->id}}"><i className="fa fa-times"></i></a>\n' +
                    '    </td>\n' +
                '</tr>';

                cartHover_tbody.append(newItem);
            }
            alert('Thêm thành công!');
            console.log(response);
        },
        error: function (response){
            alert('Thêm thất bại!');
            console.log(response);
        },
    });
}
