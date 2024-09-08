// Анимация при клике на текст "Hi, Welcome back"
const title = document.querySelector('h1');
const themeSwitch = document.getElementById('theme-switch');
const body = document.body;
const iconMoon = document.querySelector('.icon-moon');
const iconSun = document.querySelector('.icon-sun');
let colorToggle = true; // Флаг для смены цвета

// Функция для установки исходного цвета (чёрный или белый, в зависимости от темы)
function setInitialColor() {
    if (body.classList.contains('dark-mode')) {
        title.style.color = "#FFFFFF"; // Белый текст для тёмной темы
    } else {
        title.style.color = "#000000"; // Чёрный текст для светлой темы
    }
}

// Добавляем анимацию для текста при клике
title.addEventListener('click', () => {
    // Добавляем класс для анимации
    title.classList.add('bounce');

    // Меняем цвет текста
    if (colorToggle) {
        title.style.color = "#6C63FF"; // Меняем цвет на фиолетовый
    } else {
        setInitialColor(); // Возвращаем цвет на исходный (белый или чёрный)
    }

    // Переключаем флаг цвета
    colorToggle = !colorToggle;

    // Убираем класс анимации через 0.6 секунд, чтобы позволить повторно выполнять анимацию
    setTimeout(() => {
        title.classList.remove('bounce');
    }, 600); // Длительность анимации совпадает с CSS-анимацией
});

// Переключатель темы и сохранение в куки
themeSwitch.addEventListener('click', () => {
    body.classList.toggle('dark-mode');
    if (body.classList.contains('dark-mode')) {
        iconMoon.style.display = 'none';
        iconSun.style.display = 'inline';
        setCookie('theme', 'dark', 30); // Сохраняем тему в куки
    } else {
        iconMoon.style.display = 'inline';
        iconSun.style.display = 'none';
        setCookie('theme', 'light', 30); // Сохраняем светлую тему в куки
    }
    setInitialColor(); // Устанавливаем исходный цвет при смене темы
    colorToggle = true; // Сбрасываем флаг, чтобы после смены темы первое нажатие снова меняло цвет на фиолетовый
});

// Функция для установки куки
function setCookie(name, value, days) {
    let expires = "";
    if (days) {
        let date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

// Функция для получения куки
function getCookie(name) {
    let nameEQ = name + "=";
    let ca = document.cookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

// Загрузка сохраненной темы из куки
const savedTheme = getCookie('theme');
if (savedTheme === 'dark') {
    body.classList.add('dark-mode');
    iconMoon.style.display = 'none';
    iconSun.style.display = 'inline';
} else {
    iconMoon.style.display = 'inline';
    iconSun.style.display = 'none';
}

// Устанавливаем исходный цвет при загрузке
setInitialColor();
