document.addEventListener('DOMContentLoaded', function () {
  eventListeners();

  darkMode();

  const pathname = window.location.pathname;
  const routesCharCounter = [
    '/admin/properties/update.php',
    '/admin/properties/create.php',
  ];

  if (routesCharCounter.includes(pathname)) {
    charCounterHandler();
  }
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
  if (initialCount < 50) {
    charCount.classList.add('char-count');
  } else {
    charCount.classList.remove('char-count');
  }

  textarea.addEventListener('input', function () {
    const currentCount = textarea.value.length;
    charCount.textContent = currentCount;

    if (currentCount < 50) {
      charCount.classList.add('char-count');
    } else {
      charCount.classList.remove('char-count');
    }
  });
}
