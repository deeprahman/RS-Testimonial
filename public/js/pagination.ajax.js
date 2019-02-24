jQuery(document).ready(function ($) {
    var ajx = pageAjaxObj.ajax_url;

    $("#rs-dr-t-pagination").on('click', function () {
        var val_attr = $("#rs-dr-t-pagination a").attr("href");
        console.log(ajx);
        console.log(val_attr);
        $.ajax({
            type: 'POST',
            url: ajx,
            data: {
                action: 'pagination_ajax_reply',
                page_no: val_attr
            },
            success: function (data, textStatus, XMLHttpRequest) {
                console.log(data);
            }

        });
    });
});