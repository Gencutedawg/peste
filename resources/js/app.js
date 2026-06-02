import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('click', function (event) {
    var toggleButton = event.target.closest('.toggle-password-btn');

    if (!toggleButton) {
        return;
    }

    var fieldGroup = toggleButton.closest('.password-input-group') || toggleButton.parentElement;
    var passwordInput = fieldGroup ? fieldGroup.querySelector('input[type="password"], input[type="text"]') : null;

    if (!passwordInput) {
        return;
    }

    var isPassword = passwordInput.type === 'password';
    passwordInput.type = isPassword ? 'text' : 'password';
    toggleButton.classList.toggle('visible', isPassword);
    toggleButton.setAttribute('aria-label', isPassword ? 'Hide password' : 'Show password');
});
