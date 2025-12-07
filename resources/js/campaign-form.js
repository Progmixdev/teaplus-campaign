import $ from './jquery.js';
import 'jquery-validation';

$(document).ready(function() {
    const phoneExpression =
        /^(?:(?:(\+?972|\(\+?972\)|\+?\(972\)|\+?970|\(\+?970\)|\+?\(970\))(?:\s|\.|-)?([1-9]\d?))|(0[23489]{1})|(0[57]{1}[0-9]))(?:\s|\.|-)?([^0\D]{1}\d{2}(?:\s|\.|-)?\d{4})$/;

    $.validator.addMethod("PSILSPhone", function (value, element) {
        if (phoneExpression.test(value)) {
            return true;
        } else {
            return false;
        }
    });

    const campaignForm = $("#campaignForm");
    campaignForm.validate({
        rules: {
            phone_number: {
                required: true,
                PSILSPhone: true,
                minlength: 8,
                maxlength: 20,
            },
            campaign_number: {
                required: true,
                // PSILSPhone: true,
                // minlength: 8,
                // maxlength: 20,
            },
        },
        messages: {
            phone_number: {
                required: "Phone number is required",
                PSILSPhone: "Phone number is invalid",
                minlength: "Phone number must be at least 8 characters",
                maxlength: "Phone number must not exceed 20 characters",
            },
            campaign_number: {
                required: "Campaign number is required",
                // PSILSPhone: "Campaign number is invalid",
                // minlength: "Campaign number must be at least 8 characters",
                // maxlength: "Campaign number must not exceed 50 characters",
            },
        },
        errorPlacement: function (error, element) {
            error.appendTo(element.closest(".form-group"));
        },
    });
});

