/*>>>*/
// Languages menu START
const lang_list = document.querySelector('.languages-list');
const lang_current = document.querySelector('.current-language');
const toggleLanguagesMenu = () => {
    lang_list.classList.toggle('opened');
};
lang_current.addEventListener('click', toggleLanguagesMenu);


/*>>>*/
// Header sticky
const header = document.querySelector('.header');
const changeHeaderState = () => {
    const windowTop = window.pageYOffset;
    if (windowTop < 60) {
        header.classList.remove('fixed');
    } else {
        header.classList.add('fixed');
    }
};

/*>>>*/
// Blob's animations
const moveBlobs = (elem) => {
    let scroll = 0;
    window.onscroll = onScroll;

    function onScroll() {
        let top = window.pageYOffset;
        if (scroll > top) {
            elem.classList.remove('observer')
        } else if (scroll < top) {
            elem.classList.add('observer')
        }
        scroll = top;
    }
};

let blob_in_mission_first = document.querySelector('.mission__preview.first');
let blob_in_mission_second = document.querySelector('.mission__preview.second');
let blob_in_work_first = document.querySelector('.work__preview.first');
let blob_in_work_second = document.querySelector('.work__preview.second');
let blob_in_work_third = document.querySelector('.work__preview.third');
const observerForBlobs = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
        if (entry.isIntersecting) {
            moveBlobs(entry.target);
        }
    });
});

if (blob_in_mission_first) {
    observerForBlobs.observe(blob_in_mission_first);
}
if (blob_in_work_first) {
    observerForBlobs.observe(blob_in_work_first);
}
if (blob_in_work_second) {
    observerForBlobs.observe(blob_in_work_second);
}
if (blob_in_work_third) {
    observerForBlobs.observe(blob_in_work_third);
}
if (blob_in_mission_second) {
    observerForBlobs.observe(blob_in_mission_second);
}


/*>>>*/
// Sliders configs
// Hero slider
const solvedSwiperElement = document.querySelector('.solved-slider');
if (solvedSwiperElement) {
    new Swiper('.solved-slider', {
        effect: 'fade',
        fadeEffect: {
            crossFade: true
        },
        pagination: {
            el: '#solvedPagination',
            type: 'bullets',
            clickable: true,
        },
        autoHeight: true,
        speed: 800,
        loop: true,
        autoplay: {
            delay: 7000,
        },
    })
}


/*>>>*/
// Footer animation
const footer = document.querySelector('.footer');
const footer_animate_aos = document.querySelector('.footer__inner');
const footerFinding = () => {
    const documentHeight = document.body.offsetHeight;
    const windowScrollPosition = window.scrollY;
    const windowHeight = window.innerHeight;
    const footerHeight = footer.scrollHeight;
    // if(documentHeight - windowHeight <= windowScrollPosition + footerHeight){
    if (windowScrollPosition + footerHeight / 2 >= documentHeight - windowHeight) {
        footer_animate_aos.classList.add('aos-animate')
    } else {
        footer_animate_aos.classList.remove('aos-animate')
    }
};


/*>>>*/
// Modal card
const modalOverlay = document.querySelector('.modal-overlay');
const modalCloseBtn = document.querySelectorAll('.modal__close');
const modalTriggers = document.querySelectorAll('.modal-call');
const modalsAll = document.querySelectorAll('.modal');

const showModal = (elem) => {
    document.body.classList.add('no-scroll');
    modalOverlay.classList.add('show');
    let modalId = elem.dataset.modal;
    let modalCurrent = document.querySelector(`#${modalId}`);
    modalCurrent.classList.add('show');
};
const closeModal = () => {
    document.body.classList.remove('no-scroll');
    modalOverlay.classList.remove('show');
    for (let a = 0; a < modalsAll.length; a++) {
        Array.prototype.forEach.call(modalsAll, function (e) {
            e.classList.remove('show');
        });
    }
};
// show modals
for (let m = 0; m < modalTriggers.length; m++) {
    modalTriggers[m].addEventListener('click', () => {
        showModal(modalTriggers[m]);
    });
}
// close modals
for (let m = 0; m < modalCloseBtn.length; m++) {
    modalCloseBtn[m].addEventListener('click', closeModal);
}
modalOverlay.addEventListener('click', closeModal);
modalOverlay.addEventListener('click', closeModal);
for (let q = 0; q < modalsAll.length; q++) {
    modalsAll[q].addEventListener('click', (e) => {
        if (e.target === modalsAll[q]) {
            if (modalsAll[q].classList.contains('show')) {
                closeModal();
            }
        }
    });
}


/*>>>*/
// Inputs errors
const inputsInForms = document.querySelectorAll('.input-style');

const inputsFormsChange = (element) => {
    if (element.value !== '') {
        element.classList.remove('error');
    }
};
for (let m = 0; m < inputsInForms.length; m++) {
    inputsInForms[m].addEventListener('input', () => inputsFormsChange(inputsInForms[m]));
}


// Simple validate
const formValidate = (formElement) => {
    let errors = 0;
    let nameField = formElement.querySelector('#name').value;
    let emailField = formElement.querySelector('#email').value;

    if (nameField == '') {
        formElement.querySelector('#name').classList.add('error');
        errors++
    } else {
        formElement.querySelector('#name').classList.remove('error');
    }
    if (emailField == '') {
        formElement.querySelector('#email').classList.add('error');
        errors++
    } else {
        formElement.querySelector('#email').classList.remove('error');
    }

    return errors
};


/*>>>*/
// TABS
const tabs = document.querySelector(".tabs-wrapper");
const tabButton = document.querySelectorAll(".tabs-button");
const contents = document.querySelectorAll(".tabs-content");
if (tabs) {
    tabs.addEventListener('click', (e) => {
        const id = e.target.dataset.id;
        if (id) {
            tabButton.forEach(btn => {
                btn.classList.remove("active");
            });
            e.target.classList.add("active");

            contents.forEach(content => {
                content.classList.remove("active");
            });
            const element = document.getElementById(id);
            element.classList.add("active");
        }
    });
}

/*>>>*/

// COPY TO CLIPBOARD
async function copyToClipboard(textToCopy) {
    if (navigator.clipboard && window.isSecureContext) {
        await navigator.clipboard.writeText(textToCopy);
    } else {
        const textArea = document.createElement("textarea");
        textArea.value = textToCopy;
        textArea.style.position = "absolute";
        textArea.style.left = "-999999px";
        document.body.prepend(textArea);
        textArea.select();
        try {
            document.execCommand('copy');
            alert('Text copied')
        } catch (error) {
            console.error(error);
        } finally {
            textArea.remove();
        }
    }
}

const copyButtonEl = document.querySelectorAll(".copy-to-clipboard");
copyButtonEl.forEach(function (elem) {
    elem.addEventListener("click", async (e) => {
        const target = e.currentTarget;
        const inputEl = target.previousElementSibling;
        try {
            await copyToClipboard(inputEl.value);
        } catch (error) {
            console.error(error);
        }
    });

});


/*>>>*/
// WINDOW_LISTENERS, FUNCTIONS
const removeClassesOnScroll = () => {
    lang_list.classList.remove('opened');
};

window.addEventListener('scroll', () => {
    removeClassesOnScroll();
    changeHeaderState();
    footerFinding();
});

window.addEventListener('load', () => {
    changeHeaderState();
    footerFinding();
});

import {Form} from "./form.js";
Form.start()