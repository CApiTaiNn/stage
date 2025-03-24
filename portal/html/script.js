document.addEventListener('DOMContentLoaded', function() {
    const langElements = document.querySelectorAll('[data-lang]');
    langElements.forEach(element => {
        element.addEventListener('click', function() {
            const lang = this.getAttribute('data-lang');
            changeLanguage(lang);
        });
    });

    function changeLanguage(lang) {
        const elements = document.querySelectorAll('[data-lang-fr], [data-lang-en]');
        elements.forEach(element => {
            const text = element.getAttribute(`data-lang-${lang}`);
            if (text) {
                element.textContent = text;
            }
        });
    }
});



