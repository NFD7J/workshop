<?php $title = "Gestion des ateliers" ?>
<!-- Menu secondaire -->
<nav class="submenu">
    <ul>
        <li><a href="index.php?controller=admin" class="active">Ateliers</a></li>
        <li><a href="index.php?controller=admin&action=reservation">Réservations</a></li>
        <li><a href="index.php?controller=admin&action=category">Catégories</a></li>
    </ul>
</nav>

<section class="activity-list" style="position: relative;">
    <h2>Liste des activités</h2>
    <a href="index.php?controller=admin&action=addWorkshop" class="btn-nav" style="text-decoration: none; position: absolute; right: 0; top: 0;">+ Ajouter</a>
    <ul>
        <?php foreach($workshops as $workshop): ?>
        <a href="index.php?controller=admin&action=editWorkshop&id=<?= $workshop->workshops_id ?>" data-id="<?= $workshop->workshops_id ?>" style="text-decoration: none; color: inherit;" class="workshop">
            <li class="activity-item">
                <span class="activity-title"><?= $workshop->title ?></span>
                <span class="activity-info">
                    📅 <?= date('j F Y', strtotime($workshop->date)) ?>  
                    ⏰ <?= date('H\hi', strtotime($workshop->date)) ?>  
                </span>
                <span class="activity-date">
                    👥 <?= $workshop->capacity_left ?> /
                    <?= $workshop->capacity ?> restantes
                </span>
            </li>
        </a>
        <?php endforeach; ?>
    </ul>
</section>

<!-- Modifier workshop -->
<section class="add-event">
    <a href="index.php?controller=admin" class="back-btn">← Retour</a>
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

<!-- JS -->
<script>
    const workshops = document.querySelectorAll('.workshop')
    const sectionAdd = document.querySelector('.add-event')
    const formModal = document.querySelector('.add-event form')
    const list = document.querySelector('.activity-list')
    const btnRetour = document.querySelector('.back-btn')

    workshops.forEach(workshop =>{
        workshop.addEventListener('click', (e) =>{
            e.preventDefault()
            link = workshop.getAttribute('href');
            fetch(link)
            .then(response => response.json())
            .then(data => {
                document.querySelector('.add-event form input[name="title"]').value = data.workshop.libelle;
                document.querySelector('.add-event form input[name="description"]').value = data.workshop.description;
                document.querySelector('.add-event form input[name="datetime"]').value = data.workshop.date;
                document.querySelector('.add-event form input[name="datetime"]').value = data.workshop.date;
                document.querySelector('.add-event form input[name="id"]').value = data.workshop.workshops_id;
                let supprimer = document.getElementById('supprimer');
                if(data.workshops_count <= 0) {
                    supprimer.style.display = 'block';
                    supprimer.setAttribute('href', 'index.php?controller=admin&action=deleteCategory&id=' + data.category_id);
                } else {
                    supprimer.style.display = 'none';
                }
            });
            Modal.style.display = 'flex';
        })
    })
    
    btnRetour.addEventListener('click', (e) =>{
        e.preventDefault()
        list.style.display = "block"
        sectionAdd.style.display = "none"
    })
</script>

<!-- CSS -->
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

    .activity-list {
        max-width: 1000px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .activity-list h2 {
        font-size: 1.8rem;
        margin-bottom: 20px;
        color: #333;
    }

    .activity-list ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .activity-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 20px;
        border-radius: 12px;
        background: #f9f9f9;
        margin-bottom: 12px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .activity-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 14px rgba(0,0,0,0.08);
    }

    .activity-title {
        font-weight: 600;
        color: #333;
    }

    .activity-info {
        font-size: 0.9rem;
        color: #555;
        display: flex;
        gap: 15px;
    }
/*** Modal edit ***/
    .add-event {
        display: none;
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
        right: 10px;
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

    .back-btn {
        display: inline-flex;
        align-items: center;
        position: absolute;
        top: 10px;
        left: 10px;
        padding: 8px 14px;
        background: #cdcdcd;
        color: black;
        font-weight: 600;
        text-decoration: none;
        border-radius: 10px;
        transition: all 0.2s ease;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    .back-btn:hover {
        background: #f0f0f0;
        color: #2563eb;
        box-shadow: 0 4px 12px rgba(163, 163, 163, 0.3);
    }

</style>
