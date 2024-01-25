$(document).ready(function(){
        
    $('.add-to-cart-btn').click(function(e){
        e.preventDefault();
        var product_id = $(this).closest('.product_data').find('.product_id').val();
        var product_quantity = $(this).closest('.product_data').find('.quantity-input').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method: "POST",
            url: "/add-to-cart",
            data: {
                'product_id': product_id,
                'product_quantity': product_quantity,
            },
            success: function(response){
                swal(response.status);
            }
        });
    });

    $('.increment-btn').click(function(e){
        e.preventDefault();
        // var inc_value = $('.quantity-input').val();
        var inc_value = $(this).closest('.product_data').find('.quantity-input').val();
        var value = parseInt(inc_value, 10);
        value = isNaN(value) ? 0 : value;
        if(value < 10){
            value+=1;
            // $('.quantity-input').val(value);
            $(this).closest('.product_data').find('.quantity-input').val(value);
        }
    });

    $('.decrement-btn').click(function(e){
        e.preventDefault();
        var dec_value = $(this).closest('.product_data').find('.quantity-input').val();
        var value = parseInt(dec_value, 10);
        value = isNaN(value) ? 0 : value;
        if(value > 1){
            value-=1;
            $(this).closest('.product_data').find('.quantity-input').val(value);
        }
    });

    $('.delete-cart-item-btn').click(function(e){
        e.preventDefault();
        var product_id = $(this).closest('.product_data').find('.product_id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });    
        $.ajax({
            method: 'POST',
            url: '/delete-cart-item',
            data: {
                'product_id': product_id,
            },
            success: function(response){
                window.location.reload();
                swal("", response.status, 'success');
                
            }
        });
    });

    $('.change-quantity').click(function(e){
        e.preventDefault();
        var product_id = $(this).closest('.product_data').find('.product_id').val();
        var quantity = $(this).closest('.product_data').find('.quantity-input').val();
        data = {
            'product_id': product_id,
            'product_quantity': quantity,
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });    
        $.ajax({
            method: 'POST',
            url: "update-cart",
            data: data,
            success: function(response){
                window.location.reload();
            }
        });
    });

});