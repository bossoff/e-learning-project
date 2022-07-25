<section class="category-header-area" style="background-image: url('<?php echo base_url('uploads/system/shopping_cart.png'); ?>');
    background-size: contain;
    background-repeat: no-repeat;
    background-position-x: right;
    background-color: #ec5252;">
    <div class="image-placeholder-1"></div>
    <div class="container-lg breadcrumb-container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item display-6 fw-bold">
                <a href="<?php echo site_url('home'); ?>">
                    <?php echo site_phrase('home'); ?>
                </a>
            </li>
            <li class="breadcrumb-item active text-light display-6 fw-bold">
                <?php echo site_phrase('shopping_cart'); ?>
            </li>
          </ol>
        </nav>
    </div>
</section>

<section class="cart-list-area">
    <div class="container">
        <div class="row" id="cart_items_details">
            <?php include "shopping_cart_inner_view.php"; ?>
        </div>
    </div>
</section>
<script src="https://www.paypalobjects.com/js/external/dg.js"></script>
<script>
    var dgFlow = new PAYPAL.apps.DGFlow({
        trigger: 'submitBtn'
    });
    dgFlow = top.dgFlow || top.opener.top.dgFlow;
    dgFlow.closeFlow();
    // top.close();
</script>

<script type="text/javascript">
    function removeFromCartList(elem) {
        url1 = '<?php echo site_url('home/handleCartItems'); ?>';
        url2 = '<?php echo site_url('home/refreshWishList'); ?>';
        url3 = '<?php echo site_url('home/refreshShoppingCart'); ?>';
        $.ajax({
            url: url1,
            type: 'POST',
            data: {
                course_id: elem.id
            },
            success: function(response) {

                $('#cart_items').html(response);
                if ($(elem).hasClass('addedToCart')) {
                    $('.big-cart-button-' + elem.id).removeClass('addedToCart')
                    $('.big-cart-button-' + elem.id).text("<?php echo site_phrase('add_to_cart'); ?>");
                } else {
                    $('.big-cart-button-' + elem.id).addClass('addedToCart')
                    $('.big-cart-button-' + elem.id).text("<?php echo site_phrase('added_to_cart'); ?>");
                }

                $.ajax({
                    url: url2,
                    type: 'POST',
                    success: function(response) {
                        $('#wishlist_items').html(response);
                    }
                });

                $.ajax({
                    url: url3,
                    type: 'POST',
                    success: function(response) {
                        $('#cart_items_details').html(response);
                    }
                });
            }
        });
    }

    function handleCheckOut() {
        $.ajax({
            url: '<?php echo site_url('home/isLoggedIn?url_history='.base64_encode(current_url())); ?>',
            success: function(response) {
                if (!response) {
                    window.location.replace("<?php echo site_url('login'); ?>");
                } else if ("<?php echo $total_price; ?>" > 0) {
                    // $('#paymentModal').modal('show');
                    //$('.total_price_of_checking_out').val($('#total_price_of_checking_out').text());
                    window.location.replace("<?php echo site_url('home/payment'); ?>");
                } else {
                    toastr.error('<?php echo site_phrase('there_are_no_courses_on_your_cart'); ?>');
                }
            }
        });
    }

    function handleCartItems(elem) {
        var couponCode = $("#coupon-code").val();

        url1 = '<?php echo site_url('home/handleCartItems'); ?>';
        url2 = '<?php echo site_url('home/refreshWishList'); ?>';
        url3 = '<?php echo site_url('home/refreshShoppingCart'); ?>';
        $.ajax({
            url: url1,
            type: 'POST',
            data: {
                course_id: elem.id
            },
            success: function(response) {
                $('#cart_items').html(response);
                if ($(elem).hasClass('addedToCart')) {
                    $('.big-cart-button-' + elem.id).removeClass('addedToCart')
                    $('.big-cart-button-' + elem.id).text("<?php echo site_phrase('add_to_cart'); ?>");
                } else {
                    $('.big-cart-button-' + elem.id).addClass('addedToCart')
                    $('.big-cart-button-' + elem.id).text("<?php echo site_phrase('added_to_cart'); ?>");
                }
                $.ajax({
                    url: url2,
                    type: 'POST',
                    success: function(response) {
                        $('#wishlist_items').html(response);
                    }
                });

                $.ajax({
                    url: url3,
                    type: 'POST',
                    data: {
                        couponCode: couponCode
                    },
                    success: function(response) {
                        $('#cart_items_details').html(response);
                    }
                });
            }
        });
    }

    function applyCoupon() {
        $("#spinner").removeClass('hidden');
        var couponCode = $("#coupon-code").val();
        url3 = '<?php echo site_url('home/refreshShoppingCart'); ?>';
        $.ajax({
            url: url3,
            type: 'POST',
            data: {
                couponCode: couponCode
            },
            success: function(response) {
                $("#spinner").addClass('hidden');
                $('#cart_items_details').html(response);
            }
        });
    }
</script>