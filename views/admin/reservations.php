<?php $title = "Réservations" ?>
<!-- Menu secondaire -->
<nav class="submenu">
    <ul>
        <li><a href="index.php?controller=admin">Ateliers</a></li>
        <li><a href="index.php?controller=admin&action=reservation" class="active">Réservations</a></li>
    </ul>
</nav>
<section class="activity-list">
    <h2>Les réservations</h2>
    <ul>

        <?php foreach ($reservations as $reservation): ?>
            <a href="index.php?controller=admin&action=deleteReservation&id=<?= $reservation->reservations_id ?>" style="text-decoration: none; color: inherit;">
                <li class="activity-item <?= $reservation->date >= date('Y-m-d') ? 'upcoming' : 'past' ?>">
                    <div class="activity-title"><?= $reservation->title ?></div>
                    <div class="activity-info">
                        <span>Nom : <?= $reservation->name ?></span>
                        <span>Email : <?= $reservation->email ?></span>
                    </div>
                    <div class="activity-date">
                        <span>📅 <?= date('d/m/Y', strtotime($reservation->date)) ?></span>
                        <span>⏰ <?= date('H:i', strtotime($reservation->date)) ?></span>
                        <span class="status">
                            <?= $reservation->date >= date('Y-m-d') ? 'À venir' : 'Passée' ?>
                        </span>
                    </div>
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


    .status {
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .upcoming .status {
        background: #e0e7ff;
        color: #4338ca;
    }

    .past .status {
        background: #f1f5f9;
        color: #64748b;
    }

</style>