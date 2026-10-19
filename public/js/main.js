document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.querySelector('.menu-toggle');
    const nav = document.querySelector('.nav-links');
    toggle?.addEventListener('click', () => nav?.classList.toggle('open'));

    document.querySelectorAll('.nav-links a').forEach(link => {
        link.addEventListener('click', () => nav?.classList.remove('open'));
    });

    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', () => {
            const input = document.getElementById(button.dataset.target);
            if (!input) return;
            input.type = input.type === 'password' ? 'text' : 'password';
            button.textContent = input.type === 'password' ? 'Show' : 'Hide';
        });
    });

    const form = document.getElementById('register-form');
    form?.addEventListener('submit', event => {
        const password = document.getElementById('Pwd');
        const confirmation = document.getElementById('CPwd');
        if (password && confirmation && password.value !== confirmation.value) {
            event.preventDefault();
            confirmation.setCustomValidity('Passwords do not match.');
            confirmation.reportValidity();
        }
    });

    document.getElementById('CPwd')?.addEventListener('input', event => {
        event.target.setCustomValidity('');
    });
});


document.querySelectorAll('.geo-button').forEach(button => {
  button.addEventListener('click', () => {
    const form = button.closest('.geo-form');
    if (!navigator.geolocation) { alert('Geolocation is not supported.'); return; }
    navigator.geolocation.getCurrentPosition(pos => {
      form.querySelector('[name="latitude"]').value = pos.coords.latitude;
      form.querySelector('[name="longitude"]').value = pos.coords.longitude;
      form.submit();
    }, () => alert('Location permission is required for check-in.'));
  });
});
