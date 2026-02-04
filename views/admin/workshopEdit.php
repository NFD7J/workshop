<?php $title = "Modifier un événement" ?>
<nav class="submenu">
    <ul>
        <li><a href="index.php?controller=admin">Ateliers</a></li>
        <li><a href="index.php?controller=admin&action=reservation">Réservations</a></li>
    </ul>
</nav>
<section class="add-event">
    <h2>Modifier un événement</h2>
    <a href="index.php?controller=admin&action=deleteWorkshop&id=<?= $workshop->workshops_id ?>" class="btn-danger">Supprimer</a>
    <form action="index.php?controller=admin&action=editWorkshop&id=<?= $workshop->workshops_id ?>" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Titre :</label>
            <input type="text" id="title" name="title" required value="<?= $workshop->title ?>">
        </div>

        <div class="form-group">
            <label for="description">Description :</label>
            <textarea id="description" name="description" rows="6" required><?= $workshop->description ?></textarea>
        </div>

        <div class="form-group">
            <label for="datetime">Date et heure :</label>
            <input type="datetime-local" id="datetime" name="datetime" required value="<?= $workshop->date ?>">
        </div>

        <div class="form-group">
            <label for="category">Catégorie :</label>
            <select id="category" name="category" required>
                <option value="">-- Sélectionnez une catégorie --</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category->category_id ?>" <?= $category->category_id == $workshop->category_id ? 'selected' : '' ?>><?= $category->libelle ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="capacity">Capacité :</label>
            <input type="number" id="capacity" name="capacity" min="1" required value="<?= $workshop->capacity ?>">
        </div>

        <div class="form-group">
            <label for="image">Image :</label>
            <input type="file" id="image" name="image">
            <img src="../views/images/<?= $workshop->image ?>" alt="<?= $workshop->title ?>">
        </div>

        <input type="hidden" name="id" value="<?= $workshop->workshops_id ?>">
        <button type="submit" class="btn-submit">Modifier l'événement</button>
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
        position: relative;
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

    .btn-danger {
        display: inline-block;
        position: absolute;
        top: 10px;
        left: 10px;
        margin-bottom: 20px;
        padding: 10px 15px;
        background-color: #e53e3e;
        color: white;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 500;
        transition: background-color 0.3s ease;
    }
    .btn-danger:hover {
        background-color: #c53030;
    }

</style>