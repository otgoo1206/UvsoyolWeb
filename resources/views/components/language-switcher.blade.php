<div class="notranslate language-switcher flex items-center gap-1 rounded-lg border border-gray-400/30 bg-black/5 p-1 text-sm font-medium backdrop-blur-sm md:border-gray-300/40 md:group-hover:bg-white/10 md:group-hover:border-gray-300/40 transition-colors duration-500" translate="no">
    <button type="button" data-lang="mn"
        class="lang-btn rounded-md px-3 py-1.5 transition-colors duration-200 text-gray-900 hover:bg-[#831518]/60 hover:text-slate-100 md:text-[#831518] md:group-hover:text-slate-100">
        МН
    </button>
    <button type="button" data-lang="en"
        class="lang-btn rounded-md px-3 py-1.5 transition-colors duration-200 text-gray-900 hover:bg-[#831518]/60 hover:text-slate-100 md:text-[#831518] md:group-hover:text-slate-100">
        EN
    </button>
</div>

<div id="google_translate_element" class="hidden" aria-hidden="true"></div>

<script>
    // The company name is excluded from Google Translate (class="notranslate"
    // on the element, data-mn/data-en holding the two fixed strings) so it
    // never gets machine-mistranslated. We swap it ourselves here, which
    // works immediately on page load and does not depend on Google's
    // translate widget script having finished loading.
    function applyBrandName(lang) {
        document.querySelectorAll('.brand-name').forEach((el) => {
            el.textContent = lang === 'en' ? el.dataset.en : el.dataset.mn;
        });
    }

    function setActiveButton(lang) {
        document.querySelectorAll('.lang-btn').forEach((btn) => {
            const isActive = btn.dataset.lang === lang;
            btn.classList.toggle('bg-[#831518]/70', isActive);
            btn.classList.toggle('text-slate-100', isActive);
            btn.classList.toggle('shadow-sm', isActive);
        });
    }

    function applyLanguage(lang) {
        applyBrandName(lang);
        setActiveButton(lang);
        localStorage.setItem('preferred_lang', lang);
        document.documentElement.lang = lang;

        const tryApply = setInterval(() => {
            const select = document.querySelector('.goog-te-combo');
            if (!select) return;

            clearInterval(tryApply);
            select.value = lang;
            select.dispatchEvent(new Event('change'));
        }, 100);
    }

    // Apply the saved language to the brand name and buttons right away,
    // without waiting on the (slower, external, sometimes blocked) Google
    // Translate script below.
    const initialLang = localStorage.getItem('preferred_lang') || 'mn';
    applyBrandName(initialLang);
    setActiveButton(initialLang);
    document.documentElement.lang = initialLang;

    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'mn',
            includedLanguages: 'en,mn',
            autoDisplay: false,
        }, 'google_translate_element');

        if (initialLang !== 'mn') {
            applyLanguage(initialLang);
        }
    }

    document.querySelectorAll('.lang-btn').forEach((btn) => {
        btn.addEventListener('click', () => applyLanguage(btn.dataset.lang));
    });
</script>
<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<style>
    .goog-te-banner-frame,
    .skiptranslate iframe,
    #goog-gt-tt,
    .goog-te-balloon-frame {
        display: none !important;
    }

    body {
        top: 0 !important;
    }

    .goog-te-gadget {
        display: none !important;
    }
</style>
