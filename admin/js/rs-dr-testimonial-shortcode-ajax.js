jQuery(document).ready(function ($) {
    $(".jQuery_accordion").accordion({
        collapsible: true, heightStyle: 'content'
    });
    var url = ajax_short.ajaxurl;
    $('#testimonial').change(function () {
        var value = $(this).val();
        switch (value) {
            case 'random': {
                tb_show("Shortcode Generator Options", "#TB_inline?inlineId=rs-dr-t-random");
                break;
            }
            case 'cycle': {
                tb_show("Shortcode Generator Options", "#TB_inline?inlineId=rs-dr-t-cycle");
                break;
            }
            case 'single': {
                tb_show("Shortcode Generator Options", "#TB_inline?inlineId=rs-dr-t-single");
                break;
            }
        }
    });
    $('.rs-dr-t-button').click(function () {
        var id_of_thicbox = $(this).attr('id');
        console.log(id_of_thicbox);
        switch (id_of_thicbox) {
            case 'button-random': {
                //Filter value
                var cat = $('#rs-dr-t-rand-cat').val();
                var count = $('#rs-dr-t-rand-count').val();
                //Checkbox Value
                var image = $('#rs-dr-t-rand-image:checkbox:checked').val();
                var excerpt = $('#rs-dr-t-rand-excerpt:checkbox:checked').val();
                var title = $('#rs-dr-t-rand-title:checkbox:checked').val();
                var name = $('#rs-dr-t-rand-name:checkbox:checked').val();
                var email = $('#rs-dr-t-rand-email:checkbox:checked').val();
                var location = $('#rs-dr-t-rand-location:checkbox:checked').val();
                var position = $('#rs-dr-t-rand-position:checkbox:checked').val();
                var review = $('#rs-dr-t-rand-review:checkbox:checked').val();
                var date = $('#rs-dr-t-rand-date:checkbox:checked').val();
                var rating = $('#rs-dr-t-rand-rate:checkbox:checked').val();

                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        action: 'rs_dr_t_shortcode_gen',

                        cat: cat,
                        count: count,

                        image: image,
                        excerpt: excerpt,
                        title: title,
                        name: name,
                        email: email,
                        location: location,
                        position: position,
                        review: review,
                        date: date,
                        rating: rating,
                        box: 'rand'
                    },
                    success: function (resp) {
                        $('#shortcode').html(resp);
                    }
                });
                break;
            }
            case 'button-cycle': {
                var count = $('#rs-dr-t-cycle-count').val();
                var cat = $('#rs-dr-t-cycle-cat').val();
                var ordby = $('#rs-dr-t-cycle-orderby').val();
                var ord = $('#rs-dr-t-cycle-order').val();

                var image = $('#rs-dr-t-cycle-image:checkbox:checked').val();
                var excerpt = $('#rs-dr-t-cycle-excerpt:checkbox:checked').val();
                var title = $('#rs-dr-t-cycle-title:checkbox:checked').val();
                var name = $('#rs-dr-t-cycle-name:checkbox:checked').val();
                var email = $('#rs-dr-t-cycle-email:checkbox:checked').val();
                var location = $('#rs-dr-t-cycle-location:checkbox:checked').val();
                var position = $('#rs-dr-t-cycle-position:checkbox:checked').val();
                var review = $('#rs-dr-t-cycle-review:checkbox:checked').val();
                var date = $('#rs-dr-t-cycle-date:checkbox:checked').val();
                var rating = $('#rs-dr-t-cycle-rate:checkbox:checked').val();

                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        action: 'rs_dr_t_shortcode_gen',

                        count: count,
                        cat: cat,
                        ordby: ordby,
                        ord: ord,
                        image: image,
                        excerpt: excerpt,
                        title: title,
                        name: name,
                        email: email,
                        location: location,
                        position: position,
                        review: review,
                        date: date,
                        rating: rating,

                        box: 'cycle'
                    },
                    success: function (resp) {
                        $('#shortcode').html(resp);
                    }
                });
                break;
            }
            case 'button-single': {
                var post_id = $('#rs-dr-t-single-post').val();
                //Checkbox Value
                var image = $('#rs-dr-t-single-image:checkbox:checked').val();
                var excerpt = $('#rs-dr-t-single-excerpt:checkbox:checked').val();
                var title = $('#rs-dr-t-single-title:checkbox:checked').val();
                var name = $('#rs-dr-t-single-name:checkbox:checked').val();
                var email = $('#rs-dr-t-single-email:checkbox:checked').val();
                var location = $('#rs-dr-t-single-location:checkbox:checked').val();
                var position = $('#rs-dr-t-single-position:checkbox:checked').val();
                var review = $('#rs-dr-t-single-review:checkbox:checked').val();
                var date = $('#rs-dr-t-single-date:checkbox:checked').val();
                var rating = $('#rs-dr-t-single-rate:checkbox:checked').val();
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        action: 'rs_dr_t_shortcode_gen',
                        post_id: post_id,

                        image: image,
                        excerpt: excerpt,
                        title: title,
                        name: name,
                        email: email,
                        location: location,
                        position: position,
                        review: review,
                        date: date,
                        rating: rating,

                        box: 'single'
                    },
                    success: function (resp) {
                        $('#shortcode').html(resp);
                    }
                });
                break;
            }
        }
        tb_remove();
    });
});