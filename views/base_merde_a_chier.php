<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Workshop' ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>

<header>

    <nav class="navbar">
        <a href="index.php" class="header-left"><div class="logo">Eventify</div></a>

        <button class="burger-menu" aria-label="Menu" aria-expanded="false">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <div class="nav-container">
            <ul class="header-center nav-links">
                <li><a href="index.php">Accueil</a></li>
                <li><a href="index.php?controller=workshop">Events</a></li>
                <?php if(isset($_SESSION["user"])): ?>
                    <li><a href="index.php?controller=reservation">Réservation</a></li>
                    <?php if($_SESSION["user"]['role'] === 1): ?>
                        <li><a href="index.php?controller=admin">Administration</a></li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>

            <ul class="header-right nav-links">
                <?php if(!isset($_SESSION["user"])): ?>
                    <li><a href="index.php?controller=auth">Login</a></li>
                    <li><a href="index.php?controller=auth&action=register" class="btn-nav">Register</a></li>
                <?php else: ?>
                    <li><a href="index.php?controller=auth&action=logout" class="btn-nav">Logout</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

</header>


<main>
    <?= $content ?>
</main>

<footer class="simple-footer">
    <p>© 2026 Eventify · All rights reserved</p>
</footer>



</body>
</html>
<style>

    html,body {
        height: 100%;
    }
    
    body {
        font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
        display: flex;
        flex-direction: column;
    }

    main {
        flex: 1;
    }
    
    .navbar{
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        padding: 10px 40px;
        background: white;
        box-shadow: 0 8px 30px rgba(0,0,0,0.05);
        position: sticky;
        top: 0;
        z-index: 1000;
    }

    .logo {
        font-size: 1.5rem;
        font-weight: 700;
        color: #4f46e5;
    }
    .header-left{
        text-decoration: none;
    }

    .nav-links {
        list-style: none;
        display: flex;
        gap: 30px;
        font-size: 1.1em;
    }

    .nav-links a {
        text-decoration: none;
        color: #333;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .nav-links a:hover {
        color: #4f46e5;
    }

    .btn-nav {
        padding: 10px 18px;
        border-radius: 10px;
        background: linear-gradient(135deg, #6366f1, #4f46e5);
        color: white !important;
        font-weight: 600;
    }

    .btn-nav:hover {
        opacity: 0.9;
    }

    .simple-footer {
        text-align: center;
        padding: 20px;
        background: #fcfcfc;
        color: #64748b;
        font-size: 0.9rem;
        box-shadow: 0 -8px 30px rgba(0,0,0,0.05);
        bottom: 0;
    }

    /* Menu Burger */
    .burger-menu {
        display: none;
        flex-direction: column;
        gap: 5px;
        background: none;
        border: none;
        cursor: pointer;
        padding: 5px;
        z-index: 1001;
    }

    .burger-menu span {
        width: 25px;
        height: 3px;
        background-color: #333;
        border-radius: 3px;
        transition: all 0.3s ease;
    }

    .burger-menu.active span:nth-child(1) {
        transform: rotate(45deg) translate(7px, 7px);
    }

    .burger-menu.active span:nth-child(2) {
        opacity: 0;
    }

    .burger-menu.active span:nth-child(3) {
        transform: rotate(-45deg) translate(7px, -7px);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .burger-menu {
            display: flex;
        }

        .nav-container {
            position: fixed;
            top: 0;
            right: -100%;
            width: 70%;
            max-width: 300px;
            height: 100vh;
            background: white;
            box-shadow: -5px 0 20px rgba(0,0,0,0.1);
            transition: right 0.3s ease;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            padding-top: 80px;
        }

        .nav-container.active {
            right: 0;
        }

        .nav-links {
            flex-direction: column;
            gap: 0;
            width: 100%;
        }

        .header-center {
            border-bottom: 1px solid #f0f0f0;
        }

        .nav-links li {
            width: 100%;
        }

        .nav-links a {
            display: block;
            padding: 15px 25px;
            border-bottom: 1px solid #f5f5f5;
        }

        .nav-links a:hover {
            background: #f8f9fa;
        }

        .btn-nav {
            border-radius: 0 !important;
        }
    }

    
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const burgerMenu = document.querySelector('.burger-menu');
        const navContainer = document.querySelector('.nav-container');

        burgerMenu.addEventListener('click', function() {
            this.classList.toggle('active');
            navContainer.classList.toggle('active');
            
            // Update aria-expanded for accessibility
            const isExpanded = this.classList.contains('active');
            this.setAttribute('aria-expanded', isExpanded);
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.navbar')) {
                burgerMenu.classList.remove('active');
                navContainer.classList.remove('active');
                burgerMenu.setAttribute('aria-expanded', 'false');
            }
        });

        // Close menu when clicking on a link
        const navLinks = document.querySelectorAll('.nav-links a');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                burgerMenu.classList.remove('active');
                navContainer.classList.remove('active');
                burgerMenu.setAttribute('aria-expanded', 'false');
            });
        });
    });
</script>

</body>
</html>
