document.addEventListener('DOMContentLoaded', function () {
  eventListeners();

  darkMode();

  charCounterHandler();
});

function darkMode() {
  const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');

  // console.log(prefiereDarkMode.matches);

  if (prefiereDarkMode.matches) {
    document.body.classList.add('dark-mode');
  } else {
    document.body.classList.remove('dark-mode');
  }

  prefiereDarkMode.addEventListener('change', function () {
    if (prefiereDarkMode.matches) {
      document.body.classList.add('dark-mode');
    } else {
      document.body.classList.remove('dark-mode');
    }
  });

  const botonDarkMode = document.querySelector('.dark-mode-boton');

  botonDarkMode.addEventListener('click', function () {
    document.body.classList.toggle('dark-mode');
  });
}

function eventListeners() {
  const mobileMenu = document.querySelector('.mobile-menu');

  mobileMenu.addEventListener('click', navegacionResponsive);
}

function navegacionResponsive() {
  const navegacion = document.querySelector('.navegacion');

  navegacion.classList.toggle('mostrar');
}

function charCounterHandler() {
  const textarea = document.querySelector('#description');
  const charCount = document.querySelector('#charCount');

  // Calculating and displaying initial character count
  const initialCount = textarea.value.length;
  charCount.textContent = initialCount;

  // Adding class to the count if exceeding the limit
  if (initialCount < 50 || initialCount > 250) {
    charCount.classList.add('char-count');
  }

  textarea.addEventListener('input', function () {
    const currentCount = textarea.value.length;
    charCount.textContent = currentCount;

    if (currentCount < 50 || currentCount > 250) {
      charCount.classList.add('char-count');
    } else {
      charCount.classList.remove('char-count');
    }
  });
}
