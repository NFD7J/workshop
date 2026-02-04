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
        <a href="index.php?controller=admin&action=editWorkshop&id=<?= $workshop->workshops_id ?>" style="text-decoration: none; color: inherit;">
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

</style>
