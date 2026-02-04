<?php $title = "Register" ?>
<style>
    .login-section {
        max-width: 400px;
        margin: 60px auto;
        padding: 32px;
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.05);
        text-align: center;
    }

    .login-section h2 {
        margin-bottom: 24px;
        font-size: 1.8rem;
        color: #2563eb;
    }

    .login-form .form-group {
        margin-bottom: 18px;
        text-align: left;
    }

    .login-form label {
        display: block;
        margin-bottom: 6px;
        font-weight: 500;
        color: #333;
    }

    .login-form input {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 1rem;
        transition: border 0.2s ease, box-shadow 0.2s ease;
    }

    .login-form input:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.2);
        outline: none;
    }

    .login-form button.btn-primary {
        width: 100%;
        margin-top: 12px;
    }

    .login-footer {
        margin-top: 16px;
        font-size: 0.9rem;
    }

    .login-footer a {
        color: #2563eb;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.2s ease;
    }

    .login-footer a:hover {
        color: #1e4ed8;
    }

    .btn-primary {
        display: inline-block;
        padding: 12px 28px;
        font-size: 1rem;
        font-weight: 600;
        text-decoration: none;
        color: #fff;
        background: linear-gradient(135deg, #2563eb, #1e40af);
        border: none;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.25s ease;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
    }

    /* Hover – soulève le bouton + intensifie le dégradé */
    .btn-primary:hover {
        box-shadow: 0 8px 20px rgba(37, 99, 235, 0.4);
        background: linear-gradient(135deg, #1e40af, #1e3a8a);
    }

    /* Active – clique appuyé */
    .btn-primary:active {
        transform: translateY(1px);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
    }

</style>
<section class="login-section">

    <h2>Création de compte</h2>
    <?php if(isset($error)): ?>
        <div class="error-message" style="color: red; margin-bottom: 16px;">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>
    <form action="index.php?controller=auth&action=register" method="POST" class="login-form">
        
        <div class="form-group">
            <label for="name">Nom</label>
            <input type="text" id="name" name="name" placeholder="Votre nom" required>
        </div>
        <div class="form-group">
            <label for="email">Adresse email</label>
            <input type="email" id="email" name="email" placeholder="votre@email.com" required>
        </div>

        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required>
        </div>

        <button type="submit" class="btn-primary">S'inscrire</button>

    </form>

</section>
<script>
    const password = document.getElementById('password');
    const name = document.getElementById('name');
    const email = document.getElementById('email');

    let passwordTimeout;

    password.addEventListener('input', function () {
        clearTimeout(passwordTimeout);

        passwordTimeout = setTimeout(() => {
            if (password.value.length < 6) {
                password.style.borderColor = 'red';
                errorMessage(
                    'Le mot de passe doit contenir au moins 6 caractères.',
                    password
                );
            } else {
                password.style.borderColor = '#ccc';
                clearErrors(password);
            }
        }, 1000);
    });

    name.addEventListener('input', function() {
        clearTimeout(passwordTimeout);

        passwordTimeout = setTimeout(() => {
            if (name.value.trim() === '') {
                name.style.borderColor = 'red';
                errorMessage('Le nom ne peut pas être vide.', name);
            } else {
                name.style.borderColor = '#ccc';
                clearErrors(name);
            }
        }, 1000);
    });
    
    email.addEventListener('input', function() {
        clearTimeout(passwordTimeout);

        passwordTimeout = setTimeout(() => {
            const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
            if (!email.value.match(emailPattern)) {
                email.style.borderColor = 'red';
                errorMessage('Veuillez entrer une adresse email valide.', email);
            } else {
                email.style.borderColor = '#ccc';
                clearErrors(email);
            }
        }, 1000);
    });

    function errorMessage(message, field) {
        if(!field.previousElementSibling || !field.previousElementSibling.classList.contains('error-message')) {
            const errorDiv = document.createElement('div');
            errorDiv.className = 'error-message';
            errorDiv.style.color = 'red';
            errorDiv.style.marginBottom = '16px';
            errorDiv.textContent = message;
            field.parentNode.insertBefore(errorDiv, field);
        }
    }

    function clearErrors(field) {
        if(field.previousElementSibling && field.previousElementSibling.classList.contains('error-message')) {
            field.previousElementSibling.remove();
        }
    }
</script>