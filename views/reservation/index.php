<section class="reservations">
    <h2>My reservations</h2>

    <div class="reservations-group">
        <h3>Upcoming</h3>

        <ul class="reservation-list">
            <?php foreach($reservations as $reservation): ?>
                <a href="index.php?controller=workshop&action=show&id=<?= $reservation->workshops_id ?>" data-id="<?= $reservation->reservations_id ?>" class="onclick">
                    <li class="reservation-item">
                        <div>
                            <h4><?= $reservation->title ?></h4>
                            <p>📅 <?= date('j F Y', strtotime($reservation->date)) ?> · ⏰ <?= date('H\hi', strtotime($reservation->date)) ?></p>
                        </div>
                        <span class="status">Upcoming</span>
                    </li>
                </a>
                <div style="display: flex; justify-content: flex-end;" data-id="<?= $reservation->reservations_id ?>">
                    <a href="index.php?controller=reservation&action=delete&id=<?= $reservation->reservations_id ?>" id="<?= $reservation->reservations_id ?>" class="onclick btn-annuler">Annuler réservation</a>
                </div>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="reservations-group">
        <h3>Past</h3>
        
        <ul class="reservation-list">
            <?php foreach($pastReservations as $reservation): ?>
                <a href="index.php?controller=workshop&action=show&id=<?= $reservation->workshops_id ?>" id="<?= $reservation->reservations_id ?>" class="onclick">
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

<!-- Modal delete -->
<div id="backgroundModalDelete">
    <div role="alert" class="logout-alert">
        <p>Voulez-vous supprimer cette réservation ?</p>
        <form action="" method="POST" class="logout-form">
            <input type="hidden" name="id" value="">
            <input type="submit" name="true" class="btn-oui" value="OUI">
            <input type="button" name="false" class="btn-non" value="NON">
        </form>
    </div>
</div>

<!-- CSS -->
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

/*** modal delete ***/
    #backgroundModalDelete {
        display: none;
        height: 100vh;
        width: 100vw;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1000;
        background: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
    }

    .logout-alert {
        background: white;
        padding: 30px 40px;
        border-radius: 12px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }

    .logout-alert p {
        font-size: 1.1rem;
        margin-bottom: 24px;
        color: #333;
        font-weight: 500;
    }

    .logout-form {
        display: flex;
        justify-content: center;
        gap: 16px;
    }

    .logout-form input[type="submit"], .logout-form input[type="button"] {
        padding: 10px 24px;
        font-size: 1rem;
        font-weight: 600;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.25s ease;
    }

    /* Bouton OUI – primaire */
    .btn-oui {
        background: linear-gradient(135deg, #eb2525, #af1e1e);
        color: #fff;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
    }

    .btn-oui:hover {
        box-shadow: 0 8px 20px rgba(37, 99, 235, 0.4);
        background: linear-gradient(135deg, #af1e1e, #8a1e1e);
    }

    .btn-oui:active {
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
    }

    /* Bouton NON – secondaire */
    .btn-non {
        background: #f3f4f6;
        color: #333;
        border: 1px solid #ccc;
    }

    .btn-non:hover {
        background: #e5e7eb;
    }
    
</style>

<!-- JS -->
<script>
    const modalDelete = document.getElementById('backgroundModalDelete');
    const suppr = document.querySelectorAll('.btn-annuler');
    const modal = document.querySelector('.logout-alert');
    const logoutForm = document.querySelector('.logout-form');
    suppr.forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            document.querySelector('.logout-form input[name="id"]').value = button.id;
            modalDelete.style.display = 'flex';
        });
    });
    
    document.querySelector('.logout-form input[name="false"]').addEventListener('click', (e) => {
        modalDelete.style.display = 'none';
    });

    logoutForm.addEventListener('submit', (e) => {
        e.preventDefault();
        let formdata = new FormData(logoutForm);
        fetch("index.php?controller=reservation&action=delete", {method: 'POST', body: formdata})
            .then(response => response.json())
            .then(data => {
                document.querySelector(".reservation-list>a[data-id='" + data.id + "']").remove();
                document.querySelector(".reservation-list>div[data-id='" + data.id + "']").remove();
                modalDelete.style.display = 'none';
            });
    });
</script>