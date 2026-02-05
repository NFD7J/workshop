<?php $title = "Workshop Details" ?>
<a href="index.php?controller=workshop" class="back-btn">← Retour</a>
<section class="activity">

    <div class="activity-image">
        <img src="../views/images/<?= $workshop->image ?>" alt="<?= $workshop->title ?>">
    </div>

    <div class="activity-content">
        <h1><?= $workshop->title ?></h1>

        <div class="activity-meta">
            <span>📅 <?= date("j F Y", strtotime($workshop->date)) ?></span>
            <span>⏰ <?= date("H\hi", strtotime($workshop->date)) ?></span>
            <span>👥 <?= $workshop->capacity_left ?> seats</span>
        </div>

        <p class="activity-description">
            <?= $workshop->description ?>
        </p>
        <small><?= $workshop->available ?> seats left</small><br>
        <a href="index.php?controller=workshop&action=booking&id=<?= $workshop->workshops_id ?>" class="<?php echo $workshop->available <= 0 ? 'disabled' : 'btn'; ?>"><?= $workshop->available <=0 ? 'No seats left' : 'Book this activity' ?></a>
    </div>

</section>
<style>
    .activity {
        max-width: 1100px;
        margin: 80px auto;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
        gap: 50px;
        padding: 0 20px;
    }

    .activity-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.12);
    }

    .activity-content h1 {
        font-size: 2.4rem;
        margin-bottom: 20px;
    }

    .activity-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-bottom: 25px;
        font-size: 0.95rem;
        color: #475569;
    }

    .activity-description {
        font-size: 1.05rem;
        line-height: 1.7;
        color: #334155;
        margin-bottom: 30px;
    }

    .btn {
        display: inline-block;
        padding: 14px 28px;
        border-radius: 12px;
        background: linear-gradient(135deg, #6366f1, #4f46e5);
        color: white;
        text-decoration: none;
        font-weight: 600;
    }
    .disabled {
        cursor: not-allowed;
        display: inline-block;
        padding: 14px 28px;
        border-radius: 12px;
        background: linear-gradient(135deg, #696969, #5a5a5a);
        color: white;
        text-decoration: none;
        font-weight: 600;
    }

    .back-btn {
        display: inline-flex;
        align-items: center;
        position: absolute;
        top: 100px;
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