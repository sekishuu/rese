document.addEventListener('DOMContentLoaded', function () {
    const tabs = document.querySelectorAll('input[name="admin-tab-control"]');
    const storedTab = localStorage.getItem('selectedAdminTab') || window.location.hash.replace('#', '');

    if (storedTab) {
        const tab = document.querySelector(`input#${storedTab}`);
        if (tab) {
            tab.checked = true;
        }
    }

    tabs.forEach(tab => {
        tab.addEventListener('change', function () {
            localStorage.setItem('selectedAdminTab', this.id);
        });
    });

    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function () {
            const selectedTab = localStorage.getItem('selectedAdminTab');
            if (selectedTab) {
                this.action += `#${selectedTab}`;
            }
        });
    });
});