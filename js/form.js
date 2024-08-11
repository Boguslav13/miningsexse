import {
    Helper
} from "./helper.js";

let Form = {
    selectors: {
        'testFormSelector': '#test-form',
        'subscribeFormSelector': '#subscribe-form',
        'feedbackFormSelector': '#feedbackForm',
        'congratulationsModalSelector': '#congratulationsModal'
    },
    start: function () {
        $(this.selectors.testFormSelector).on('click', 'button', this.testFormSubmit)
        $(this.selectors.testFormSelector).on('change', 'input[type=radio]', this.otherInput)
        $(this.selectors.testFormSelector).on('click', 'input[type=checkbox]', this.cursorPosition)
        $(this.selectors.congratulationsModalSelector).on('click', 'button', this.goHome)
        $(this.selectors.subscribeFormSelector).on('click', 'button', this.subscribeFormSubmit)
        $(this.selectors.feedbackFormSelector).on('click', 'button', this.feedbackFormSubmit)
    },
    testFormSubmit: function () {
        let button = $(this),
            buttonContent = button.html()

        $.ajax({
            type: "POST",
            url: "actions/form.php",
            dataType: 'json',
            data: $(`${Form.selectors.testFormSelector} input[type=radio]:checked, ${Form.selectors.testFormSelector} textarea, ${Form.selectors.testFormSelector} input[type=text], ${Form.selectors.testFormSelector} input[type=email], ${Form.selectors.testFormSelector} input[type=checkbox]:checked`),
            beforeSend: function () {
                Helper.loadingButton(button)
                Helper.removeValidation(Form.selectors.testFormSelector)
            },
            success: function (json) {
                Helper.loadingButton(button, buttonContent)
                if (json.error) {
                    $.each(json.error, function (key, value) {
                        $(`${Form.selectors.testFormSelector} input[name=${key}]`).addClass('error').parent().append(Helper.invalidFeedback(value, true))
                    });

                    $('html, body').animate({
                        scrollTop: $(".invalid-feedback").closest('.test__part').offset().top
                    }, 500);
                }
                if (json.fatal) {
                    button.after(Helper.invalidFeedback(json.fatal))
                }

                if (json.success) {
                    Helper.modalShow('#congratulationsModal')
                }
            }
        })
    },
    subscribeFormSubmit: function () {
        let button = $(this),
            buttonContent = button.html()

        $.ajax({
            type: "POST",
            url: "actions/subscribe.php",
            dataType: 'json',
            data: $(`${Form.selectors.subscribeFormSelector} input[type=email]`),
            beforeSend: function () {
                Helper.loadingButton(button)
                Helper.removeValidation(Form.selectors.subscribeFormSelector)
            },
            success: function (json) {
                Helper.loadingButton(button, buttonContent)
                if (json.error) {
                    $.each(json.error, function (key, value) {
                        $(`${Form.selectors.subscribeFormSelector} input[name=${key}]`).addClass('error').parent().after(Helper.invalidFeedback(value, true))
                    });
                }
                if (json.fatal) {
                    button.after(Helper.invalidFeedback(json.fatal))
                }

                if (json.success) {
                    $('#congratulationsModal').find('.modal__title').html('You subscribed')
                    $('#congratulationsModal').find('.modal__comment').html('Thank you for subscribing to our news')
                    $('#congratulationsModal').find('.modal__body').remove()
                    $('input').val('')
                    Helper.modalShow('#congratulationsModal')
                }
            }
        })
    },
    feedbackFormSubmit: function () {
        let button = $(this),
            buttonContent = button.html()

        $.ajax({
            type: "POST",
            url: "actions/feedback.php",
            dataType: 'json',
            data: $(`${Form.selectors.feedbackFormSelector} textarea, ${Form.selectors.feedbackFormSelector} input[type=text], ${Form.selectors.feedbackFormSelector} input[type=email]`),
            beforeSend: function () {
                Helper.loadingButton(button)
                Helper.removeValidation(Form.selectors.feedbackFormSelector)
            },
            success: function (json) {
                Helper.loadingButton(button, buttonContent)
                if (json.error) {
                    $.each(json.error, function (key, value) {
                        $(`${Form.selectors.feedbackFormSelector} input[name=${key}]`).addClass('error').parent().append(Helper.invalidFeedback(value, true))
                    });
                }

                if (json.fatal) {
                    button.after(Helper.invalidFeedback(json.fatal))
                }

                if (json.success) {
                    Helper.modalHide('#feedbackModal')
                    Helper.modalShow('#congratulationsModal')
                }
            }
        })
    },
    otherInput: function () {
        let name = $(this).attr('name')

        if ($(this).val() != `other-${name}`) {
            $(`#${name}-variant`).closest('.test__single-box-variants').css('display', 'none')
        }
        if ($(this).val() == `other-${name}`) {
            $(`#${name}-variant`).closest('.test__single-box-variants').css('display', 'block')
        }
    },
    cursorPosition: function (e) {
        $(this).val(e.pageX + '-' + e.pageY)
    },
    goHome: function () {
        window.location.href = '/'
    }
};

export {
    Form
}