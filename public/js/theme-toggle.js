document.addEventListener('turbolinks:load', () => {
    const sunIcon = document.getElementById('sun-icon');
    const moonIcon = document.getElementById('moon-icon');

    if (document.documentElement.classList.contains('dark')) {
        moonIcon.style.display = 'block';
        sunIcon.style.display = 'none';
    } else {
        sunIcon.style.display = 'block';
        moonIcon.style.display = 'none';
    }
});

function toggleDarkMode() {
    const html = document.documentElement;
    const sunIcon = document.getElementById('sun-icon');
    const moonIcon = document.getElementById('moon-icon');

    if (html.classList.contains('dark')) {
        html.classList.remove('dark');
        localStorage.theme = 'light';
        sunIcon.style.display = 'block';
        moonIcon.style.display = 'none';
    } else {
        html.classList.add('dark');
        localStorage.theme = 'dark';
        sunIcon.style.display = 'none';
        moonIcon.style.display = 'block';
    }
}
