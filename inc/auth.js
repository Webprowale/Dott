
function togglePassword() {
    var passwordInput = document.getElementById('passwordInput');
    var passwordToggle = document.getElementById('passwordToggle');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        passwordToggle.innerHTML = '<i class="fas fa-eye-slash"></i>';
    } else {
        passwordInput.type = 'password';
        passwordToggle.innerHTML = '<i class="fas fa-eye"></i>';
    }
}

