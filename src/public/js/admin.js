document.addEventListener('DOMContentLoaded', function () {
    const tabs = document.querySelectorAll('input[name="tab-control"]');
    const storedTab = localStorage.getItem('selectedTab') || window.location.hash.replace('#', '');

    if (storedTab) {
        const tab = document.getElementById(storedTab);
        if (tab) {
            tab.checked = true;
        }
    }

    tabs.forEach(tab => {
        tab.addEventListener('change', function () {
            localStorage.setItem('selectedTab', this.id);
        });
    });

    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function () {
            const selectedTab = localStorage.getItem('selectedTab');
            if (selectedTab) {
                this.action += `#${selectedTab}`;
            }
        });
    });
});