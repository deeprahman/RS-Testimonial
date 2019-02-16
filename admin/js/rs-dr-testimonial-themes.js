"use strict";
jQuery(document).ready(function ($) {
    //Get the saved value
    var value = $("#rs-dr-t-themes").val();
    switch (value) {
        case '1': {
            var style = `<div class="rs-dr-container">`;
            break;
        }
        case '2': {
            var style = "background: #555653; color: silver;";
            break;
        }
        case '3': {
            var style = "background: #ebede6; color: #161616;";
            break;
        }
        default: {
            var style = "border: none;";
            break;
        }
    }
    var my_style = `<style>.rs-dr-container{${style}}</style>`;
    $("#my-style").html(my_style);

    //Get value on change
    $("#rs-dr-t-themes").change(function () {
        var value = $(this).val();
        switch (value) {
            case '1': {
                var style = `<div class="rs-dr-container">`;
                break;
            }
            case '2': {
                var style = "background: #555653; color: silver;";
                break;
            }
            case '3': {
                var style = "background: #ebede6; color: #161616;";
                break;
            }
            default: {
                var style = "border: none;";
                break;
            }
        }
        var my_style = `<style>.rs-dr-container{${style}}</style>`;
        $("#my-style").html(my_style);
    });
});