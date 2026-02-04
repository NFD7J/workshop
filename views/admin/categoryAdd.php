<?php $title = "Ajouter une catégorie" ?>
<a href="index.php?controller=admin&action=category" class="back-btn">← Retour</a>
<nav class="submenu">
    <ul>
        <li><a href="index.php?controller=admin">Ateliers</a></li>
        <li><a href="index.php?controller=admin&action=reservation">Réservations</a></li>
        <li><a href="index.php?controller=admin&action=category" class="active">Catégories</a></li>
    </ul>
</nav>
<section class="add-event">
    <h2>Ajouter une catégorie</h2>
    <form action="index.php?controller=admin&action=addCategory" method="POST">
        <div class="form-group">
            <label for="title">Nom de la catégorie :</label>
            <input type="text" id="title" name="title" required>
        </div>
        <button type="submit" class="btn-submit">Ajouter la catégorie</button>
    </form>
</section>
<style>
    .submenu {
        display: flex;
        justify-content: center;
        background-color: #f4f5f7;
        padding: 8px 40px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }

    .submenu ul {
        list-style: none;
        display: flex;
        gap: 20px;
        margin: 0;
        padding: 0;
    }

    .submenu a {
        text-decoration: none;
        color: #4f46e5;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .submenu a:hover {
        color: #6366f1;
    }

    .submenu a.active {
        border-bottom: 3px solid #4f46e5;
    }
    
    .add-event {
        max-width: 600px;
        margin: 40px auto;
        padding: 20px;
        background: #f9f9f9;
        border-radius: 12px;
        box-shadow: 0 6px 15px rgba(0,0,0,0.05);
    }

    .add-event h2 {
        text-align: center;
        color: #4f46e5;
        margin-bottom: 25px;
    }

    .form-group {
        margin-bottom: 15px;
        display: flex;
        flex-direction: column;
    }

    .form-group label {
        margin-bottom: 5px;
        font-weight: 500;
        color: #333;
    }

    .form-group input,
    .form-group textarea,
    .form-group select {
        padding: 10px 12px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 1rem;
        transition: border-color 0.3s ease;
    }

    .form-group input:focus,
    .form-group textarea:focus,
    .form-group select:focus {
        outline: none;
        border-color: #4f46e5;
    }

    .btn-submit {
        display: block;
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 10px;
        background: linear-gradient(135deg, #6366f1, #4f46e5);
        color: white;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: opacity 0.3s ease;
    }

    .btn-submit:hover {
        opacity: 0.9;
    }

    .back-btn {
        display: inline-flex;
        align-items: center;
        position: absolute;
        top: 120px;
        left: 20px;
        padding: 8px 14px;
        background: #f3f4f6;
        color: #2563eb;
        font-weight: 600;
        text-decoration: none;
        border-radius: 10px;
        transition: all 0.2s ease;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    .back-btn:hover {
        background: #cdcdcd;
        color: white;
        box-shadow: 0 4px 12px rgba(163, 163, 163, 0.3);
    }

</style>