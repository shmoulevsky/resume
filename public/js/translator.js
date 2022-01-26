let tr = {
    i18n: function($key) {
        let $currentLang = localStorage.getItem('locale') ?? 'ru';
        return lang[$currentLang][$key];
    }
};
