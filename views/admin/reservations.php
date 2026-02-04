<?php $title = "Réservations" ?>
<!-- Menu secondaire -->
<nav class="submenu">
    <ul>
        <li><a href="index.php?controller=admin">Ateliers</a></li>
        <li><a href="index.php?controller=admin&action=reservation" class="active">Réservations</a></li>
    </ul>
</nav>
<section class="reservations">
    <h2>Les réservations</h2>
    <a href="index.php?controller=admin&action=addReservation" class="btn-nav" style="text-decoration: none; position: absolute; right: 20px; top: 0;">+ Ajouter</a>
    <ul class="reservation-list">

        <?php foreach ($reservations as $reservation): ?>
            <a href="index.php?controller=admin&action=deleteReservation&id=<?= $reservation->reservations_id ?>" style="text-decoration: none; color: inherit;">
                <li class="reservation <?= $reservation->date >= date('Y-m-d') ? 'upcoming' : 'past' ?>">
                    <div class="reservation-title"><?= $reservation->title ?></div>
                    <div class="reservation-info">
                        <span>Nom : <?= $reservation->name ?></span>
                        <span>Email : <?= $reservation->email ?></span>
                    </div>
                    <div class="reservation-date">
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
    .reservations {
        position: relative;
        max-width: 900px;
        margin: 60px auto;
        padding: 0 20px;
    }

    .reservations h2 {
        font-size: 2rem;
        margin-bottom: 30px;
    }

    .reservation-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .reservation {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 18px 24px;
        margin-bottom: 15px;
        background: white;
        border-radius: 14px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.06);
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .reservation:hover {
        transform: translateY(-1px);
        box-shadow: 0 14px 40px rgba(0,0,0,0.08);
    }

    .reservation-title {
        font-weight: 600;
        font-size: 1.1rem;
    }

    .reservation-info {
        display: flex;
        gap: 20px;
        color: #555;
        font-size: 0.95rem;
    }

    .reservation-date {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 0.90rem;
    }

    .status {
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .reservation.upcoming .status {
        background: #e0e7ff;
        color: #4338ca;
    }

    .reservation.past .status {
        background: #f1f5f9;
        color: #64748b;
    }

</style>