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

        <ul class="header-center nav-links">
            <li><a href="index.php">Accueil</a></li>
            <li><a href="index.php?controller=workshop">Events</a></li>
            <?php if(isset($_SESSION["user"])): ?>
                <li><a href="index.php?controller=reservation">Réservation</a></li>
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

    
</style>