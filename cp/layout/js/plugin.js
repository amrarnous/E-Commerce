/*global $*/
$(function () {
    "use strict";
    
    $('input').each(function () {
        if ($(this).attr("required") === "required") {
            $(this).after("<span class='asterisk'>*</span>");
        }
    });
});