<?php $title = "All Workshops & Events" ?>
<section class="events-list">
    <h2>All Workshops & Events</h2>

    <ul class="list">
        <?php foreach($workshops as $workshop): ?>
        <a href="index.php?controller=workshop&action=show&id=<?= $workshop->workshops_id ?>" class="onclick">
            <li class="list-item">
                <div>
                    <h3><?= $workshop->title ?></h3>
                    <p><?= $workshop->description ?></p>
                </div>
                <div style="display: flex; flex-direction: column; gap: 5px; align-items: center;">
                    <span class="meta">📅 <?= date("d/m/Y", strtotime($workshop->date)) ?></span>
                    <span class="meta"><?= date("H\hi", strtotime($workshop->date)) ?></span>
                    <span class="meta">👥 <?= $workshop->capacity ?> seats</span>
                </div>
            </li>
        </a>
        <?php endforeach; ?>
    </ul>
</section>

<aside class="sidebar">
    <h3>Filter by category</h3>

    <ul class="filters">
        <form action="index.php?controller=workshop&action=index" method="post">
            <div class="div-btn">
                <input type="submit" class="btn" value="rechercher">
            </div>
        <?php foreach($categories as $category): ?>
            <li>
                <label>
                    <input type="checkbox" name="category[]" value="<?= $category->category_id ?>" <?php if(isset($_POST['category']) && in_array($category->category_id, $_POST['category'])) echo 'checked'; ?>>
                    <?= $category->libelle ?>
                </label>
            </li>
        <?php endforeach; ?>
        </form>
    </ul>
</aside>


<style>
    .events-list {
        max-width: 900px;
        margin: 80px auto;
        padding: 0 20px;
    }

    .events-list h2 {
        margin-bottom: 30px;
        font-size: 2rem;
    }

    .list {
        list-style: none;
    }

    .onclick{
        text-decoration: none;
    }

    .list-item {
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 25px;
        background: white;
        border-radius: 12px;
        margin-bottom: 15px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.06);
        transition: transform 0.2s ease;
    }

    .list-item:hover {
        transform: translateX(5px);
    }

    .list-item h3 {
        margin-bottom: 5px;
        font-size: 1.2rem;
    }

    .list-item p {
        color: #64748b;
        font-size: 0.95rem;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 3;
        overflow: hidden;
    }

    .list-item>div:first-child {
        padding-right: 2em;
    }

    .meta {
        font-size: 0.9rem;
        color: #475569;
        white-space: nowrap;
    }
/*aside*/
    .sidebar {
        position: fixed;
        top: 100px;
        width: 160px;
        background: white;
        padding: 25px;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.06);
    }

    .sidebar h3 {
        font-size: 1.1rem;
        margin-bottom: 20px;
    }

    .filters {
        list-style: none;
        padding: 0;
    }

    .filters li {
        margin-bottom: 15px;
    }

    .filters label {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #475569;
        cursor: pointer;
    }

    .filters input[type="checkbox"] {
        accent-color: #4f46e5;
    }
    .div-btn{
        width: 100%;
        display: flex;
        justify-content: end;
        margin: 1em 0;
    }
    .btn {
        cursor: pointer;
        padding: 9px;
        border-radius: 10px;
        background: linear-gradient(135deg, #6366f1, #4f46e5);
        border: none;
        color: white;
        text-decoration: none;
        font-weight: 600;
    }

    .onclick{
        text-decoration: none;
        color: inherit;
    }
</style>