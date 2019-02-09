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
                //Checkbox Value
                var image = $('#rs-dr-t-rand-image:checkbox:checked').val();
                var excerpt = $('#rs-dr-t-rand-excerpt:checkbox:checked').val();
                var title = $('#rs-dr-t-rand-title:checkbox:checked').val();
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        action: 'rs_dr_t_shortcode_gen',
                        image: image,
                        excerpt: excerpt,
                        title: title,
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
                var image = $('#rs-dr-t-cycle-image:checkbox:checked').val();
                var excerpt = $('#rs-dr-t-cycle-excerpt:checkbox:checked').val();
                var title = $('#rs-dr-t-cycle-title:checkbox:checked').val();
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        action: 'rs_dr_t_shortcode_gen',
                        count: count,
                        image: image,
                        excerpt: excerpt,
                        title: title,
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
                var image = $('#rs-dr-t-single-image:checkbox:checked').val();
                var excerpt = $('#rs-dr-t-single-excerpt:checkbox:checked').val();
                var title = $('#rs-dr-t-single-title:checkbox:checked').val();
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        action: 'rs_dr_t_shortcode_gen',
                        post_id: post_id,
                        image: image,
                        excerpt: excerpt,
                        title: title,
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