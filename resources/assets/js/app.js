import $ from "./jquery.js";
import "./shared.js";

import "jquery-validation";

(($) => {
    const phoneExpression =
        /^(?:\+?(?:972|970)5\d{7,8}|00(?:972|970)5\d{7,8}|0?5\d{8,9})$/;

    const form = $("#validate-form");

    jQuery.validator.addMethod(
        "palestineMobile",
        function (value, element) {
            return phoneExpression.test(value);
        },
        "رقم الهاتف غير صالح"
    );

    form.validate({
        rules: {
            campaign_number: {
                required: true,
            },
            phone: {
                required: true,
                palestineMobile: true,
                minlength: 9,
                maxlength: 14,
            },
        },
        messages: {
            campaign_number: {
                required: "رقم الحملة مطلوب",
            },
            phone: {
                required: "رقم الهاتف مطلوب",
                palestineMobile: "رقم الهاتف غير صالح",
                minlength: "رقم الهاتف يجب أن يكون 9 أرقام على الأقل",
                maxlength: "رقم الهاتف يجب أن يكون 14 أرقام على الأكثر",
            },
        },
        errorPlacement: function (error, element) {
            element.closest(".form-group").append(error);
        },
    });

    window.onSubmit = function (token) {
        if (form.valid()) {
            $.ajax({
                url: form.attr("data-action"),
                data: form.serialize(),
                type: "POST",
                datatype: "json",
                beforeSend: function () {
                    const submitBtn = $(form).find("#register-submit");
                    submitBtn
                        .prop("disabled", true)
                        .addClass("disabled")
                        .data("original-text", submitBtn.html());
                    submitBtn.html("جاري الإرسال...");
                },
                success: function (response) {
                    $("#alert-message").html(
                        '<div class="alert alert-success mb-30">' +
                            response.message +
                            "</div>"
                    );
                    form.remove();
                },
                error: function (xhr) {
                    $(".form-group .error-message").remove();
                    if (xhr.status === 422) {
                        // Validation errors
                        let errors = xhr.responseJSON?.errors;
                        if (errors) {
                            $.each(errors, function (field, messages) {
                                let input = $('[name="' + field + '"]');
                                let formGroup = input.closest(".form-group");

                                formGroup.append(
                                    '<label class="error">' +
                                        messages[0] +
                                        "</label>"
                                );
                            });
                        } else {
                            let errorMessage =
                                xhr.responseJSON?.message ||
                                "حدث خطأ غير متوقع1";
                            $("#alert-message").html(
                                '<div class="alert alert-danger mb-30">' +
                                    errorMessage +
                                    "</div>"
                            );
                        }
                    } else {
                        let errorMessage =
                            xhr.responseJSON?.message || "2حدث خطأ غير متوقع";
                        $("#alert-message").html(
                            '<div class="alert alert-danger mb-30">' +
                                errorMessage +
                                "</div>"
                        );
                    }
                    if (typeof grecaptcha !== "undefined") {
                        grecaptcha.reset();
                    }
                },
                complete: function () {
                    const submitBtn = $(form).find("#register-submit");
                    submitBtn.prop("disabled", false).removeClass("disabled");
                    submitBtn.html(
                        submitBtn.data("original-text") || "سجل الان"
                    );
                    if (typeof grecaptcha !== "undefined") {
                        grecaptcha.reset();
                    }
                },
            });
        } else {
            if (typeof grecaptcha !== "undefined") {
                grecaptcha.reset();
            }
        }
    };

    let captchaLoaded = false;
    form.on("click", ".g-recaptcha", function (e) {
        checkCaptcha();
    });

    $(window).on("mousemove click touchstart touchmove scroll", function (e) {
        checkCaptcha();
    });

    const checkCaptcha = () => {
        if (window.functions.has_captcha && !captchaLoaded) {
            const script = $(
                `<script src="${window.functions.captcha_url}"></script>`
            );
            $("head").append(script);
            captchaLoaded = true;
        }
    };
})(jQuery);
