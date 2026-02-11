<section class="reservations">
    <h2>My reservations</h2>

    <div class="reservations-group">
        <h3>Upcoming</h3>

        <ul class="reservation-list">
            <?php foreach($reservations as $reservation): ?>
                <a href="index.php?controller=workshop&action=show&id=<?= $reservation->workshops_id ?>" class="onclick">
                    <li class="reservation-item">
                        <div>
                            <h4><?= $reservation->title ?></h4>
                            <p>📅 <?= date('j F Y', strtotime($reservation->date)) ?> · ⏰ <?= date('H\hi', strtotime($reservation->date)) ?></p>
                        </div>
                        <span class="status">Upcoming</span>
                    </li>
                </a>
                <div style="display: flex; justify-content: flex-end;">
                    <a href="index.php?controller=reservation&action=delete&id=<?= $reservation->reservations_id ?>" class="onclick btn-annuler">Annuler réservation</a>
                </div>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="reservations-group">
        <h3>Past</h3>
        
        <ul class="reservation-list">
            <?php foreach($pastReservations as $reservation): ?>
                <a href="index.php?controller=workshop&action=show&id=<?= $reservation->workshops_id ?>" class="onclick">
                    <li class="reservation-item past">
                        <div>
                            <h4><?= $reservation->title ?></h4>
                            <p>📅 <?= date('j F Y', strtotime($reservation->date)) ?> · ⏰ <?= date('H\hi', strtotime($reservation->date)) ?></p>
                        </div>
                        <span class="status past">Completed</span>
                    </li>
                </a>
            <?php endforeach; ?>
        </ul>
    </div>
</section>
<style>
    .reservations {
        max-width: 900px;
        margin: 80px auto;
        padding: 0 20px;
    }

    .reservations h2 {
        margin-bottom: 30px;
        font-size: 2rem;
    }

    .reservations-group {
        margin-bottom: 40px;
    }

    .reservations-group h3 {
        margin-bottom: 15px;
        font-size: 1.3rem;
    }

    .reservation-list {
        list-style: none;
        padding: 0;
    }

    .reservation-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: white;
        margin-bottom: 5px;
        padding: 20px 25px;
        border-radius: 12px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.06);
        transition: transform 0.2s ease;
    }

    .reservation-item:hover {
        transform: translateX(5px);
    }
    
    .reservation-item h4 {
        margin-bottom: 5px;
    }

    .reservation-item p {
        color: #64748b;
        font-size: 0.95rem;
    }

    .status {
        font-size: 0.85rem;
        padding: 6px 12px;
        border-radius: 20px;
        background: #dcfce7;
        color: #166534;
        font-weight: 600;
    }

    .status.past {
        background: #e5e7eb;
        color: #374151;
    }

    .onclick{
        text-decoration: none;
        color: inherit;
        display: block;
    }

    .btn-annuler{
        display: inline-block;
        padding: 8px 16px;
        margin-bottom: 16px;
        border-radius: 8px;
        background: #ef4444;
        color: white;
        text-decoration: none;
        font-weight: 600;
    }
    .btn-annuler:hover{
        background: #dc2626;
    }
    
</style>