<?php $title = "Accueil"?>
<style>
    .events {
        padding: 80px 20px;
        background: linear-gradient(135deg, #f8f9fc, #eef1f7);
    }

    .events-header {
        text-align: center;
        margin-bottom: 50px;
    }

    .events-header h2 {
        font-size: 2.2rem;
        margin-bottom: 10px;
    }

    .events-header p {
        color: #666;
    }

    .events-grid {
        max-width: 1100px;
        margin: auto;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 30px;
    }

    .event-card {
        background: white;
        max-width: 45%;
        min-width: 400px;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 15px 40px rgba(0,0,0,0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .event-card:hover {
        box-shadow: 0 25px 60px rgba(0,0,0,0.12);
    }

    .event-image {
        position: relative;
        height: 200px;
        overflow: hidden;
    }

    .event-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .event-card:hover img {
        transform: scale(1.08);
    }

    .tag {
        position: absolute;
        top: 15px;
        right: 15px;
        background: #4f46e5;
        color: white;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 0.8rem;
    }

    .event-content {
        padding: 25px;
    }

    .event-content h3 {
        font-size: 1.4rem;
        margin-bottom: 10px;
    }

    .event-content p {
        color: #555;
        line-height: 1.5;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 5;
        overflow: hidden;
    }

    .event-info {
        display: flex;
        justify-content: space-between;
        margin: 20px 0;
        font-size: 0.9rem;
        color: #666;
    }

    .btn {
        display: block;
        text-align: center;
        padding: 12px;
        border-radius: 10px;
        background: linear-gradient(135deg, #6366f1, #4f46e5);
        color: white;
        text-decoration: none;
        font-weight: 600;
        transition: opacity 0.3s ease;
    }

    .btn:hover {
        opacity: 0.85;
    }
</style>
<section class="events">
    <div class="events-header">
        <h2>Upcoming Workshops & Events</h2>
        <p>Discover our next sessions and book your place</p>
    </div>

    <div class="events-grid">
        <?php foreach($events as $event): ?>
        <article class="event-card">
            <div class="event-image">
                <img src="../views/images/<?php echo $event->image; ?>" alt="<?php echo $event->title; ?>">
            </div>

            <div class="event-content">
                <h3><?php echo $event->title; ?></h3>
                <p><?php echo $event->description; ?></p>

                <div class="event-info">
                    <span>📅 <?php echo $event->date; ?></span>
                    <span>👥 <?php echo $event->capacity; ?> seats <br>
                    👥 <?php echo $event->capacity_left; ?> left</span>
                </div>

                <a href="index.php?controller=workshop&action=show&id=<?= $event->workshops_id ?>" class="btn">Book now</a>
            </div>
        </article>
        <?php endforeach; ?>
    </div>
</section>



