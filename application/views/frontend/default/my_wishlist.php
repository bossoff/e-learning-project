<?php include "profile_menus.php"; ?>

<section class="my-courses-area">
    <div class="container">
        <div class="row">
            <div class="ms-auto col-lg-6 px-4">
                <div class="row bg-white radius-8 py-1 px-1">
                    <div class="col-12 p-0">
                        <form action="javascript:;">
                            <div class="input-group common-search-box">
                                <input type="text" class="form-control py-2" placeholder="<?php echo site_phrase('search_my_wishlist'); ?>"  onkeyup="getMyWishListsBySearchString(this.value)">
                                <dib class="input-group-button">
                                    <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                                </dib>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row no-gutters" id="my_wishlists_area">
            <?php include "reload_my_wishlists.php"; ?>
        </div>
    </div>
</section>

<script type="text/javascript">
    function getMyWishListsBySearchString(search_string) {
        $('#my_wishlists_area').html('<div class="animated-loader"><div class="spinner-border text-secondary" role="status"></div></div>');
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url('home/get_my_wishlists_by_search_string'); ?>',
            data: {
                search_string: search_string
            },
            success: function(response) {
                $('#my_wishlists_area').html(response);
            }
        });
    }

    async function handleWishList(elem) {


        try {
            var result = await async_modal();
            if (result) {
                $.ajax({
                    url: '<?php echo site_url('home/handleWishList'); ?>',
                    type: 'POST',
                    data: {
                        course_id: elem.id
                    },
                    success: function(response) {
                        if ($(elem).hasClass('active')) {
                            $(elem).removeClass('active')
                        } else {
                            $(elem).addClass('active')
                        }
                        $('#wishlist_items').html(response);
                        $.ajax({
                            url: '<?php echo site_url('home/reload_my_wishlists'); ?>',
                            type: 'POST',
                            success: function(response) {
                                $('#modal-4').modal('toggle');
                                $('#my_wishlists_area').html(response);
                            }
                        });
                    }
                });
            }
        } catch (e) {
            console.log("Error occured", e.message);
        }
    }
</script>