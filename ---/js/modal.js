const modal = document.getElementById('authModal');
        const loginForm = document.getElementById('loginForm');
        const registerForm = document.getElementById('registerForm');

        function openModal(type) {
            modal.style.display = 'flex';
            if (type === 'login') {
                loginForm.style.display = 'block';
                registerForm.style.display = 'none';
            } else {
                loginForm.style.display = 'none';
                registerForm.style.display = 'block';
            }
        }

        function closeModal() {
            modal.style.display = 'none';
        }

        function toggleForm() {
            if (loginForm.style.display === 'none') {
                loginForm.style.display = 'block';
                registerForm.style.display = 'none';
            } else {
                loginForm.style.display = 'none';
                registerForm.style.display = 'block';
            }
        }

        window.onclick = function(event) {
            if (event.target === modal) {
                closeModal();
            }
        }

        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            console.log('Inicio de sesión:', {
                email: document.getElementById('loginEmail').value,
                password: document.getElementById('loginPassword').value
            });
        });

        registerForm.addEventListener('submit', function(e) {
            e.preventDefault();
            console.log('Registro:', {
                email: document.getElementById('registerEmail').value,
                password: document.getElementById('registerPassword').value,
                confirmPassword: document.getElementById('confirmPassword').value
            });
        });