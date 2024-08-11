let Helper = {
    selectors: {
    },
    loadingButton: function (button, buttonVal = '') {
        if (!buttonVal) $(button).attr('disabled', 'disabled').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="visually-hidden">Loading...</span>')
        if (buttonVal) $(button).attr('disabled', false).html(buttonVal)
    },
    validationPhone: function () {
        this.value = this.value.replace(/[^0-9+]/g, '')
    },
    validationPassword: function () {
        this.value = this.value.replace(/[^\w\d]*/gi, '')
    },
    uploadImage: function (selector, e) {
        if (!e.target.files) return
        const file = e.target.files[0]
        if (!file.type.match('image')) return

        const reader = new FileReader()
        reader.onload = e => {
            const src = e.target.result
            $(selector).attr('src', src)
        }
        reader.readAsDataURL(file)
    },
    invalidFeedback: function (content, style = false) {
        let styleContent = style ? 'margin-top: 1rem; color: red;' : '';
        return `<div class="invalid-feedback" style="${styleContent}">${content}</div>`
    },
    removeValidation: function (selector) {
        $(selector).find('.invalid-feedback').remove()
        $(selector).find('input').removeClass('is-invalid')
    },
    dataTableLanguage: function () {
        return {
            lengthMenu: 'Показывать _MENU_',
            zeroRecords: 'Нет результатов',
            info: 'Страница _PAGE_ из _PAGES_',
            infoEmpty: 'Нет результатов',
            infoFiltered: '',
            search: 'Поиск:',
            paginate: {
                first: "Первая",
                previous: "Предыдущая",
                next: "Следующая",
                last: "Последняя"
            }
        }
    },
    modalShow: function (elem) {
        $('body').addClass('no-scroll')
        $('.modal-overlay').addClass('show')
        $(elem).addClass('show')
    },
    modalHide: function (elem) {
        $('body').removeClass('no-scroll')
        $('.modal-overlay').removeClass('show')
        $(elem).removeClass('show')
    }
}

export {
    Helper
}